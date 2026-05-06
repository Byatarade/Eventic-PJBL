<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'category',
        'location',
        'date',
        'image',
        'status',
        'terms',
        'organizer_name',
        'organizer_social',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * EO yang memiliki event ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tiket yang dimiliki event ini.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
