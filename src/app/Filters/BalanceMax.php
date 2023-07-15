<?php

namespace App\Filters;

use Closure;

class BalanceMax
{
    public function handle($data, Closure $next)
    {
        $combinedData = $data->when(request("balanceMax"), function ($q) {
            return $q->where('amount', "<=", request('balanceMax'));
        });
        return $next($combinedData);
    }
}
