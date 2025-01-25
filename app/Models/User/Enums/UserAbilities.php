<?php

namespace App\Models\User\Enums;

class UserAbilities
{
    public const ABILITIES = [
        UserRole::ADMIN->value => ['create', 'update', 'delete'],
        UserRole::POSTER->value => ['create', 'update'],
        UserRole::READER->value => [],
    ];
}
