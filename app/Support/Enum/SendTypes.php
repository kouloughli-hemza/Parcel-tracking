<?php

namespace Dsone\Support\Enum;

class SendTypes
{
    const DOMICILE = 'Domicile';
    const STOP_DESK = 'Stop-Desk';

    public static function lists(): array
    {
        return [
            self::DOMICILE => 'Domicile',
            self::STOP_DESK => 'Stop-Desk',
        ];
    }
}
