<?php

namespace App\Filters;

use Closure;

class Currency
{
    public function handle($data, Closure $next)
    {
        $combinedData = $data->when(request("currency"), function ($q) {
            return $q->where('currency', request('currency'));
        });
        return $next($combinedData);
    }
}
