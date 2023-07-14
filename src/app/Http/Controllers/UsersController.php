<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;

class UsersController extends Controller
{


    public function index()
    {
        $combinedData = collect();
        // Pagination Item for Page
        $showPerPage = 5;
        // Provider Get Data
        $dataProviders = ['DataProviderX', 'DataProviderY'];
        // filter by provider
        if (request()->has('provider') && in_array(request('provider'), $dataProviders)) {
            $combinedData = $combinedData->concat(("App\Models\\" . request('provider'))::getData());
        } else {
            foreach ($dataProviders as $provider) {
                $combinedData = $combinedData->concat(("App\Models\\" . $provider)::getData());
            }
        }

        // filter by status
        $combinedData = $combinedData->when(request("statusCode"), function ($q) {
            return $q->where('status', request('statusCode'));
        });

        // filter by balance range
        $combinedData = $combinedData->when(request('balanceMin'), function ($q) {
            return $q->where('amount', ">=", request('balanceMin'));
        });

        $combinedData = $combinedData->when(request('balanceMax'), function ($q) {
            return $q->where('amount', "<=", request('balanceMax'));
        });

        // filter by currency
        $combinedData = $combinedData->when(request("currency"), function ($q) {
            return $q->where('currency', request('currency'));
        });
        // Pagination
        $paginated = PaginationHelper::paginate($combinedData->values(), $showPerPage);
        // return results
        return response()->json($paginated);
    }
}
