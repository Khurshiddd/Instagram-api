<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Create(mixed $video)
 */
class Video extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'video'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}
