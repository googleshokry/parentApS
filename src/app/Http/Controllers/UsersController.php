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

        $combinedData = app(Pipeline::class)
            ->send($combinedData)
            ->through([
                \App\Filters\Provider::class,
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
