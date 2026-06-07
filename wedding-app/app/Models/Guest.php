<?php

namespace App\Models;

use App\Enums\GuestCategory;
use App\Enums\RsvpStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'category',
        'invitation_code',
        'max_attendees',
        'rsvp_status',
        'rsvp_note',
        'confirmed_at',
    ];

    protected $casts = [
        'category'     => GuestCategory::class,
        'rsvp_status'  => RsvpStatus::class,
        'confirmed_at' => 'datetime',
    ];

    public function scopeAttending($query)
    {
        return $query->where('rsvp_status', RsvpStatus::Attending);
    }

    public function scopeByCategory($query, GuestCategory $category)
    {
        return $query->where('category', $category);
    }

    public function rsvps()
    {
        return $this->hasMany(Rsvp::class);
    }
}
