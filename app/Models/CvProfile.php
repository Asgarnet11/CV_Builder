<?php

namespace App\Models;

use App\Traits\ClearsCvCache;
use Database\Factories\CvProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
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

    /**
     * Get the active theme accent color with SSCASN brand fallback.
     */
    public function getResolvedThemeColorAttribute(): string
    {
        return ($this->theme_color && $this->theme_color !== '#000000') ? $this->theme_color : '#269dd8';
    }

    /**
     * Calculate proportional photo dimensions preserving aspect ratio within bounds.
     *
     * @return array{0: int, 1: int} [width, height]
     */
    public function getPhotoDimensions(int $maxW = 90, int $maxH = 115): array
    {
        $photoWidth = 85;
        $photoHeight = 110;

        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            $photoPath = Storage::disk('public')->path($this->photo);
            if (file_exists($photoPath) && ($imageInfo = @getimagesize($photoPath))) {
                $origW = (int) $imageInfo[0];
                $origH = (int) $imageInfo[1];
                if ($origW > 0 && $origH > 0) {
                    $ratio = min($maxW / $origW, $maxH / $origH);
                    $photoWidth = (int) round($origW * $ratio);
                    $photoHeight = (int) round($origH * $ratio);
                }
            }
        }

        return [$photoWidth, $photoHeight];
    }
}
