<?php

namespace App\Traits;

use App\Models\AuditLog;

trait Auditable
{
    protected static function bootAuditable(): void
    {
        static::created(function ($model) {
            static::logAudit('created', $model, null, $model->getAttributes());
        });

        static::updated(function ($model) {
            $oldValues = $model->getOriginal();
            $newValues = $model->getChanges();

            // Filter out timestamps and hidden fields
            $excludeKeys = ['updated_at', 'created_at', 'remember_token', 'password'];
            $oldFiltered = array_diff_key(
                array_intersect_key($oldValues, $newValues),
                array_flip($excludeKeys)
            );
            $newFiltered = array_diff_key($newValues, array_flip($excludeKeys));

            if (!empty($newFiltered)) {
                static::logAudit('updated', $model, $oldFiltered, $newFiltered);
            }
        });

        static::deleted(function ($model) {
            static::logAudit('deleted', $model, $model->getAttributes(), null);
        });
    }

    protected static function logAudit(string $action, $model, ?array $oldValues, ?array $newValues): void
    {
        try {
            AuditLog::log(
                action: $action,
                modelType: get_class($model),
                modelId: $model->id,
                oldValues: $oldValues,
                newValues: $newValues,
                description: ucfirst($action) . ' ' . class_basename($model) . ' #' . $model->id
            );
        } catch (\Exception $e) {
            // Silently fail if logging fails - don't break the main operation
            \Illuminate\Support\Facades\Log::error('Audit log failed: ' . $e->getMessage());
        }
    }
}
