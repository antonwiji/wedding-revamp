<?php

namespace App\Enums;

enum GuestCategory: string
{
    case Family    = 'family';
    case Friend    = 'friend';
    case Colleague = 'colleague';
    case VIP       = 'vip';

    public function label(): string
    {
        return match($this) {
            self::Family    => 'Keluarga',
            self::Friend    => 'Teman',
            self::Colleague => 'Rekan Kerja',
            self::VIP       => 'VIP',
        };
    }
}
