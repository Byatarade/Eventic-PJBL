<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'type',
        'description',
        'price',
        'stock',
        'max_per_user',
    ];

    /**
     * Event yang memiliki tiket ini.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
