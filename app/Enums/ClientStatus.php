<?php


namespace App\Enums;


final class ClientStatus
{
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';

    public static function options(): array
    {
        return [self::ACTIVE, self::INACTIVE];
    }
}
