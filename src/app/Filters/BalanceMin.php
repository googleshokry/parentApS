<?php

namespace App\Filters;

use Closure;

class BalanceMin
{
    public function handle($data, Closure $next)
    {
        $data = $data->when(request("balanceMin"), function ($q) {
            return $q->where('amount', ">=", request('balanceMin'));
        });
        return $next($data);
    }
}
