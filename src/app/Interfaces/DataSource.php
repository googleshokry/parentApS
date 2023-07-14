<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface DataSource
{
    public static function getData(): collection;
}
