<?php

namespace App\Http\Controllers;

use App\Constants\ProviderConstants;
use App\Helpers\PaginationHelper;
use Illuminate\Pipeline\Pipeline;

class UsersController extends Controller
{


    public function index()
    {
        $combinedData = collect();
        // Pagination Item for Page
        $showPerPage = 5;
        // Provider Get Data
        $dataProviders = ProviderConstants::values();

        // filter by provider
        if (request()->has('provider') && in_array(request('provider'), $dataProviders)) {
            $combinedData = $combinedData->concat(("App\Models\\" . request('provider'))::getData());
        } else {
            foreach ($dataProviders as $provider) {
                $combinedData = $combinedData->concat(("App\Models\\" . $provider)::getData());
            }
        }

        $combinedData = app(Pipeline::class)
            ->send($combinedData)
            ->through([
                \App\Filters\Status::class,
                \App\Filters\Currency::class,
                \App\Filters\BalanceMax::class,
                \App\Filters\BalanceMin::class,
            ])
            ->thenReturn();


        // Pagination
        $paginated = PaginationHelper::paginate($combinedData->values(), $showPerPage);
        // return results
        return response()->json($paginated);
    }
}
