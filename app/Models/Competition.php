<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competition extends Model
{
    protected $fillable = [
        'title', 'organizer', 'category', 'competition_category', 'competition_level', 'banner', 'description', 'requirements',
        'registration_start', 'registration_end', 'event_start', 'event_end',
        'registration_url', 'location', 'contact', 'benefits', 'mode', 'delivery_mode', 'fee_amount', 'rating', 'review_count', 'views', 'is_recommended', 'status'
    ];

    protected $casts = [
        'registration_start' => 'date',
        'registration_end' => 'date',
        'event_start' => 'date',
        'event_end' => 'date',
        'is_recommended' => 'boolean',
    ];

    public function registrations(): HasMany { return $this->hasMany(Registration::class); }
}
