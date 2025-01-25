<?php

namespace App\Models\User\Enums;

use App\Models\EnumToArrayTrait;

enum UserRole: string
{
    use EnumToArrayTrait;

    case ADMIN = 'admin';

    case POSTER = 'poster';

    case READER = 'reader';
}
