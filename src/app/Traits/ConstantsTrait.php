<?php

namespace App\Traits;

trait ConstantsTrait
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function toArray(): array {
        foreach(self::cases() as $case) {
            $array[$case->name] = $case->value;
        }
        return $array;
    }

}
