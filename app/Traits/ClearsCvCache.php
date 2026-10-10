<?php

namespace App\Traits;

use App\Models\CvProfile;
use Illuminate\Support\Facades\Cache;

trait ClearsCvCache
{
    protected static function bootClearsCvCache()
    {
        static::saved(function ($model) {
            $model->clearCvCache();
        });

        static::deleted(function ($model) {
            $model->clearCvCache();
        });
    }

    public function clearCvCache()
    {
        // Try to get slug
        $slug = null;
        if ($this instanceof CvProfile) {
            $slug = $this->slug;
        } elseif ($this->user && $this->user->cvProfile) {
            $slug = $this->user->cvProfile->slug;
        }

        if ($slug) {
            foreach (['modern', 'classic', 'minimal'] as $t) {
                Cache::forget("cv_public_{$slug}_{$t}");
            }
        }
    }
}
