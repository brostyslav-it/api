<?php

namespace App\Models\Customer\Enums;

use App\Models\EnumToArrayTrait;

enum CustomerType: string
{
    use EnumToArrayTrait;

    case INDIVIDUAL = 'I';

    case BUSINESS = 'B';
}
