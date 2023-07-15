<?php

namespace App\Filters;

use App\Constants\ProviderConstants;
use Closure;

class Provider
{
    public function handle($data, Closure $next)
    {
        // Provider Get Data
        $dataProviders = ProviderConstants::values();

        // filter by provider
        if (request()->has('provider') && in_array(request('provider'), $dataProviders)) {
            $data = $data->concat(("App\Models\\" . request('provider'))::getData());
        } else {
            foreach ($dataProviders as $provider) {
                $data = $data->concat(("App\Models\\" . $provider)::getData());
            }
        }
        return $next($data);

    }
}
