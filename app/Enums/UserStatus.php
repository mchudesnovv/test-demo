<?php


namespace App\Enums;


final class UserStatus
{
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    public static function options(): array
    {
        return [self::ACTIVE, self::INACTIVE];
    }
}
