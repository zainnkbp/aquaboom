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

    protected function auditTableHasColumn(string $column): bool
    {
        $key = $this->getTable().'.'.$column;

        return static::$auditColumnCache[$key]
            ??= Schema::hasColumn($this->getTable(), $column);
    }
}
