<?php

namespace App\Lang;

enum Lang: string
{
    case CIR = 'cir';
    case LAT = 'lat';

    public function label(): string
    {
        return match($this) {
            self::CIR => 'Ћирилица',
            self::LAT => 'Latinica',
        };
    }
}