<?php

namespace App\Models;

trait EnumToArrayTrait
{
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
