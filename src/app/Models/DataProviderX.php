<?php

namespace App\Models;

use App\Interfaces\DataSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DataProviderX extends Model implements DataSource
{
    use HasFactory;
    private static $statusCodes = [
        '1' => 'authorised',
        '2' => 'decline',
        '3' => 'refunded'
    ];

    public static function getData():Collection
    {

        $dataProviderX = \File::get(storage_path('app/DataProviderX.json'));
        $data = json_decode($dataProviderX);
        return collect(array_map(function ($item) {
            return [
                'id' => $item->parentIdentification,
                'parentEmail' => $item->parentEmail,
                'amount' => $item->parentAmount,
                'currency' => $item->Currency,
                'status' => self::$statusCodes[$item->statusCode],
                'created_at' => $item->registerationDate,
            ];
        }, $data));
    }
}
