<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait AutoPruneMediaOnUpdate
{
    /**
     * Boot the trait to delete old media files when a model is updated or force-deleted.
     */
    public static function bootAutoPruneMediaOnUpdate(): void
    {
        static::updating(function ($model) {
            $mediaAttributes = property_exists($model, 'mediaAttributes')
                ? $model->mediaAttributes
                : ['image_url', 'image', 'banner_image', 'icon'];

            foreach ($mediaAttributes as $attribute) {
                if ($model->isDirty($attribute)) {
                    $oldValue = $model->getOriginal($attribute);
                    static::deleteDiskMediaFile($oldValue);
                }
            }
        });

        static::deleted(function ($model) {
            // Only prune if not soft deleted or if force deleting
            if (!method_exists($model, 'isForceDeleting') || $model->isForceDeleting()) {
                $mediaAttributes = property_exists($model, 'mediaAttributes')
                    ? $model->mediaAttributes
                    : ['image_url', 'image', 'banner_image', 'icon'];

                foreach ($mediaAttributes as $attribute) {
                    static::deleteDiskMediaFile($model->{$attribute});
                }
            }
        });
    }

    /**
     * Safely delete a media file from public/uploads.
     */
    protected static function deleteDiskMediaFile(?string $path): void
    {
        if (empty($path) || !is_string($path)) {
            return;
        }

        // Do not delete external URLs or default assets
        if (Str::startsWith($path, ['http://', 'https://', 'assets/'])) {
            return;
        }

        $clean = ltrim(str_replace(['\\', 'uploads/'], ['/', ''], $path), '/');
        $fullPath = public_path('uploads/' . $clean);

        if (File::exists($fullPath) && File::isFile($fullPath)) {
            File::delete($fullPath);
        }
    }
}
