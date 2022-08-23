<?php

namespace Dsone\Support\Enum;

class SendTypes
{
    const SIMPLE = 'Simple';
    const RAPIDE = 'Rapide';

    public static function lists()
    {
        return [
            self::SIMPLE => 'Simple',
            self::RAPIDE => 'Rapide',
        ];
    }
}
