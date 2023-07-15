<?php

namespace App\Filters;

use Closure;

class BalanceMin
{
    public function handle($data, Closure $next)
    {
        $combinedData = $data->when(request("balanceMin"), function ($q) {
            return $q->where('amount', ">=", request('balanceMin'));
        });
        return $next($combinedData);
    }
}
