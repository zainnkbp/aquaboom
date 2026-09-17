<?php

namespace App\Models\Concerns;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

/**
 * Automatically stamps created_by / updated_by columns (when they exist on the
 * table) and records a row in the audit_logs table for every create, update and
 * delete performed through Eloquent.
 */
trait HasAuditLog
{
    /**
     * Cache of "does <table> have <column>" lookups so we don't hit the schema
     * on every single save.
     *
     * @var array<string, bool>
     */
    protected static array $auditColumnCache = [];

    public static function bootHasAuditLog(): void
    {
        static::creating(function (Model $model) {
            $model->fillAuditStamp('created_by');
            $model->fillAuditStamp('updated_by');
        });

        static::updating(function (Model $model) {
            $model->fillAuditStamp('updated_by');
        });

        static::created(function (Model $model) {
            $model->writeAuditLog('created', null, $model->getAttributes());
        });

        static::updated(function (Model $model) {
            $model->writeAuditLog('updated', $model->getOriginal(), $model->getChanges());
        });

        static::deleted(function (Model $model) {
            $model->writeAuditLog('deleted', $model->getOriginal(), null);
        });
    }

    protected function fillAuditStamp(string $column): void
    {
        if (! auth()->check()) {
            return;
        }

        if (! $this->auditTableHasColumn($column)) {
            return;
        }

        // Never clobber an explicitly provided value on create.
        if ($column === 'updated_by' || empty($this->{$column})) {
            $this->{$column} = auth()->id();
        }
    }

    protected function writeAuditLog(string $action, ?array $oldValues, ?array $newValues): void
    {
        AuditLog::create([
            'model_type' => static::class,
            'model_id' => $this->getKey(),
            'action' => $action,
            'old_values' => $oldValues ? $this->pruneAuditValues($oldValues) : null,
            'new_values' => $newValues ? $this->pruneAuditValues($newValues) : null,
            'user_id' => auth()->id(),
        ]);
    }

    /**
     * Keep the audit payload readable by dropping noisy timestamp columns.
     */
    protected function pruneAuditValues(array $values): array
    {
        unset($values['updated_at'], $values['created_at']);

        return $values;
    }

    /**
     * Map of known tables that contain created_by / updated_by columns to prevent
     * hitting information_schema on every request.
     *
     * @var array<string, list<string>>
     */
    protected static array $tablesWithAuditColumns = [
        'wahanas' => ['created_by', 'updated_by'],
        'ticket_packages' => ['created_by', 'updated_by'],
        'add_ons' => ['created_by', 'updated_by'],
        'promo_codes' => ['created_by', 'updated_by'],
        'referral_codes' => ['created_by', 'updated_by'],
        'transactions' => ['created_by', 'updated_by'],
        'transaction_items' => ['created_by', 'updated_by'],
    ];

    protected function auditTableHasColumn(string $column): bool
    {
        $table = $this->getTable();

        // 1. Check statically mapped tables (Zero SQL queries, 100% fast & safe)
        if (isset(static::$tablesWithAuditColumns[$table])) {
            return in_array($column, static::$tablesWithAuditColumns[$table], true);
        }

        // 2. Check model attributes / fillable
        if ($this->isFillable($column) || array_key_exists($column, $this->attributes)) {
            return true;
        }

        // 3. Check memory cache
        $key = $table . '.' . $column;
        if (isset(static::$auditColumnCache[$key])) {
            return static::$auditColumnCache[$key];
        }

        // 4. Safe Schema check with catch for MariaDB/MySQL information_schema compatibility
        try {
            return static::$auditColumnCache[$key] = Schema::hasColumn($table, $column);
        } catch (\Throwable) {
            return static::$auditColumnCache[$key] = false;
        }
    }
}
