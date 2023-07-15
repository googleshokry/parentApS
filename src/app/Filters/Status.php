<?php

namespace App\Filters;

use Closure;

class Status
{
    public function handle($data, Closure $next)
    {
        $data = $data->when(request("statusCode"), function ($q) {
            return $q->where('status', request('statusCode'));
        });
        return $next($data);
    }
}
