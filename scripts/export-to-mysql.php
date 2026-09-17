<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Generating MySQL / MariaDB SQL Dump from PostgreSQL data...\n";

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
    'home_page_cards',
    'holidays',
    'promo_codes',
    'referral_codes',
    'transactions',
    'transaction_items',
    'transaction_add_ons',
    'audit_logs',
];

$output = "-- =========================================================\n";
$output .= "-- AQUABOOM WATERPARK - MySQL & MariaDB Database Dump\n";
$output .= "-- Generated for phpMyAdmin / Plesk MariaDB\n";
$output .= "-- =========================================================\n\n";
$output .= "SET FOREIGN_KEY_CHECKS=0;\n";
$output .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
$output .= "SET time_zone = \"+00:00\";\n\n";

foreach ($tables as $table) {
    if (!Schema::hasTable($table)) {
        continue;
    }

    $rows = DB::table($table)->get();
    $count = count($rows);
    echo "Processing table `{$table}` ({$count} rows)...\n";

    if ($count === 0) {
        continue;
    }

    $output .= "-- ---------------------------------------------------------\n";
    $output .= "-- Data for table `{$table}` ({$count} rows)\n";
    $output .= "-- ---------------------------------------------------------\n";
    $output .= "TRUNCATE TABLE `{$table}`;\n";

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
                    // Check if bool string in pgsql
                    if ($val === 't' || $val === 'true') {
                        $rowValues[] = "1";
                    } elseif ($val === 'f' || $val === 'false') {
                        $rowValues[] = "0";
                    } else {
                        // String or JSON
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

$output .= "SET FOREIGN_KEY_CHECKS=1;\n";
$output .= "-- Dump completed successfully.\n";

$destination = __DIR__ . '/../aquaboom_mysql_import_for_plesk.sql';
file_put_contents($destination, $output);

$sizeKb = round(filesize($destination) / 1024, 2);
echo "\nSUCCESS! MySQL-compatible file generated: aquaboom_mysql_import_for_plesk.sql ({$sizeKb} KB)\n";
