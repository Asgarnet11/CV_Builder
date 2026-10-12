<?php

namespace App\Models;

use App\Traits\ClearsCvCache;
use Database\Factories\CvProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class CvProfile extends Model
{
    /** @use HasFactory<CvProfileFactory> */
    use ClearsCvCache, HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * Get the user that owns the CV profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($profile) {
            if (empty($profile->slug)) {
                $baseSlug = Str::slug($profile->full_name ?? $profile->user->name ?? 'user');
                $slug = $baseSlug;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug.'-'.$count++;
                }
                $profile->slug = $slug;
            }
        });
    }
}
