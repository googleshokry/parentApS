<?php

namespace App\Filters;

use Closure;

class BalanceMax
{
    public function handle($data, Closure $next)
    {
        $data = $data->when(request("balanceMax"), function ($q) {
            return $q->where('amount', "<=", request('balanceMax'));
        });
        return $next($data);
    }
}
