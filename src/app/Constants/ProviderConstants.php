<?php

namespace App\Constants;

use App\Traits\ConstantsTrait;


enum ProviderConstants: string
{
    use ConstantsTrait;

    case DataProviderX = "DataProviderX";
    case DataProviderY = "DataProviderY";

}
