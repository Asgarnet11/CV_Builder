<?php

namespace App\Models;

use Database\Factories\CvProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CvProfile extends Model
{
    /** @use HasFactory<CvProfileFactory> */
    use HasFactory;

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
}
