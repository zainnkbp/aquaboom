<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Generating Strict MySQL Schema (CREATE TABLE) + Data Dump...\n";

$tables = [
    'migrations',
    'users',
    'roles',
    'permissions',
    'model_has_roles',
    'model_has_permissions',
    'role_has_permissions',
    'settings',
    'wahanas',
    'ticket_packages',
    'add_ons',
    'facilities',
    'faqs',
    'awards',
    'home_page_cards',
    'holidays',
    'promo_codes',
    'referral_codes',
    'transactions',
    'transaction_items',
    'transaction_add_ons',
    'audit_logs',
    'sessions',
    'cache',
    'cache_locks',
    'jobs',
    'job_batches',
    'failed_jobs',
    'password_reset_tokens'
];

$output = "-- =========================================================\n";
$output .= "-- AQUABOOM WATERPARK - FULL MySQL / MariaDB Dump\n";
$output .= "-- Schema (CREATE TABLE) + All Data\n";
$output .= "-- Ready for 1-Click Import into Empty Database in phpMyAdmin\n";
$output .= "-- =========================================================\n\n";
$output .= "SET FOREIGN_KEY_CHECKS=0;\n";
$output .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
$output .= "SET time_zone = \"+00:00\";\n\n";

foreach ($tables as $table) {
    if (!Schema::hasTable($table)) {
        continue;
    }

    echo "Exporting table `{$table}`...\n";

    // 1. Fetch column metadata from information_schema
    $cols = DB::select("
        SELECT column_name, data_type, character_maximum_length, is_nullable, column_default
        FROM information_schema.columns 
        WHERE table_schema = 'public' AND table_name = ?
        ORDER BY ordinal_position
    ", [$table]);

    $colDefs = [];
    $primaryKey = null;

    foreach ($cols as $c) {
        $name = $c->column_name;
        $type = strtolower($c->data_type);
        $nullable = $c->is_nullable === 'YES' ? 'NULL' : 'NOT NULL';
        $default = ($nullable === 'NULL') ? 'DEFAULT NULL' : '';

        if ($name === 'id') {
            $colDefs[] = "`{$name}` bigint unsigned NOT NULL AUTO_INCREMENT";
            $primaryKey = $name;
            continue;
        }

        // Map pgsql types to mysql
        if (str_contains($type, 'int') || str_contains($type, 'serial')) {
            if (str_contains($type, 'big')) {
                $sqlType = 'bigint';
            } elseif (str_contains($type, 'small')) {
                $sqlType = 'smallint';
            } else {
                $sqlType = 'int';
            }
        } elseif (str_contains($type, 'bool')) {
            $sqlType = 'tinyint(1)';
            $default = 'DEFAULT 0';
        } elseif (str_contains($type, 'numeric') || str_contains($type, 'decimal')) {
            $sqlType = 'decimal(15,2)';
            if ($nullable === 'NOT NULL') $default = 'DEFAULT 0.00';
        } elseif (str_contains($type, 'timestamp')) {
            $sqlType = 'timestamp';
            $default = ($nullable === 'NULL') ? 'DEFAULT NULL' : '';
        } elseif (str_contains($type, 'date')) {
            $sqlType = 'date';
            $default = ($nullable === 'NULL') ? 'DEFAULT NULL' : '';
        } elseif (str_contains($type, 'json')) {
            $sqlType = 'longtext';
            $default = '';
        } elseif (str_contains($type, 'text')) {
            $sqlType = 'longtext';
            $default = '';
        } else {
            $len = $c->character_maximum_length ?? 255;
            $sqlType = "varchar({$len})";
        }

        if ($c->column_default && !str_contains($c->column_default, 'nextval')) {
            $defVal = $c->column_default;
            if (str_contains($defVal, '::')) {
                $defVal = explode('::', $defVal)[0];
            }
            $defVal = trim($defVal, "'");
            if ($defVal === 'false') $defVal = '0';
            if ($defVal === 'true') $defVal = '1';
            
            if (is_numeric($defVal) || $defVal === '0' || $defVal === '1') {
                $default = "DEFAULT {$defVal}";
            } else {
                $default = "DEFAULT '{$defVal}'";
            }
        }

        if ($nullable === 'NOT NULL' && $default === 'DEFAULT NULL') {
            $default = '';
        }

        $colDefs[] = trim("`{$name}` {$sqlType} {$nullable} {$default}");
    }

    if ($primaryKey) {
        $colDefs[] = "PRIMARY KEY (`{$primaryKey}`)";
    }

    // Special table primary keys
    if ($table === 'password_reset_tokens') {
        $colDefs[] = "PRIMARY KEY (`email`)";
    } elseif ($table === 'sessions') {
        $colDefs[] = "PRIMARY KEY (`id`)";
    } elseif ($table === 'cache') {
        $colDefs[] = "PRIMARY KEY (`key`)";
    } elseif ($table === 'cache_locks') {
        $colDefs[] = "PRIMARY KEY (`key`)";
    }

    $output .= "-- ---------------------------------------------------------\n";
    $output .= "-- Table structure for `{$table}`\n";
    $output .= "-- ---------------------------------------------------------\n";
    $output .= "DROP TABLE IF EXISTS `{$table}`;\n";
    $output .= "CREATE TABLE IF NOT EXISTS `{$table}` (\n  " . implode(",\n  ", $colDefs) . "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";

    // 2. Insert Data
    $rows = DB::table($table)->get();
    $count = count($rows);

    if ($count > 0) {
        $output .= "-- Dumping data for table `{$table}` ({$count} rows)\n";
        $columns = array_keys((array) $rows[0]);
        $columnList = '`' . implode('`, `', $columns) . '`';

        $chunks = $rows->chunk(50);
        foreach ($chunks as $chunk) {
            $valuesList = [];
            foreach ($chunk as $row) {
                $rowArray = (array) $row;
                $rowValues = [];
                foreach ($columns as $col) {
                    $val = $rowArray[$col] ?? null;
                    if ($val === null) {
                        $rowValues[] = "NULL";
                    } elseif (is_bool($val)) {
                        $rowValues[] = $val ? "1" : "0";
                    } elseif (is_numeric($val) && !is_string($val)) {
                        $rowValues[] = $val;
                    } else {
                        if ($val === 't' || $val === 'true') {
                            $rowValues[] = "1";
                        } elseif ($val === 'f' || $val === 'false') {
                            $rowValues[] = "0";
                        } else {
                            $escaped = str_replace(["\\", "'"], ["\\\\", "\\'"], (string) $val);
                            $escaped = str_replace(["\r", "\n"], ["\\r", "\\n"], $escaped);
                            $rowValues[] = "'{$escaped}'";
                        }
                    }
                }
                $valuesList[] = "(" . implode(", ", $rowValues) . ")";
            }
            $output .= "INSERT INTO `{$table}` ({$columnList}) VALUES\n" . implode(",\n", $valuesList) . ";\n";
        }
        $output .= "\n";
    }
}

$output .= "SET FOREIGN_KEY_CHECKS=1;\n";
$output .= "-- Dump completed successfully.\n";

$destination = __DIR__ . '/../aquaboom_mysql_import_for_plesk.sql';
file_put_contents($destination, $output);

$sizeKb = round(filesize($destination) / 1024, 2);
echo "\nSUCCESS! Strict MySQL file generated: aquaboom_mysql_import_for_plesk.sql ({$sizeKb} KB)\n";
