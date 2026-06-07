<?php

namespace App\Enums;

enum RsvpStatus: string
{
    case Pending      = 'pending';
    case Attending    = 'attending';
    case NotAttending = 'not_attending';

    public function label(): string
    {
        return match($this) {
            self::Pending      => 'Menunggu Konfirmasi',
            self::Attending    => 'Hadir',
            self::NotAttending => 'Tidak Hadir',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Pending      => 'yellow',
            self::Attending    => 'green',
            self::NotAttending => 'red',
        };
    }
}
