<?php

namespace App\Filters;

use Closure;

class Status
{
    public function handle($data, Closure $next)
    {
        $combinedData = $data->when(request("statusCode"), function ($q) {
            return $q->where('status', request('statusCode'));
        });
        return $next($combinedData);
    }
}
