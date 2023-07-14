<?php

namespace App\Models;

use App\Interfaces\DataSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DataProviderY extends Model implements DataSource
{
    use HasFactory;

    private static $statusCodes = [
        '100' => 'authorised',
        '200' => 'decline',
        '300' => 'refunded'
    ];

    public static function getData(): Collection
    {
        $dataProviderY = \File::get(storage_path('app/DataProviderY.json'));
        $data = json_decode($dataProviderY);
        return collect(array_map(function ($item) {
            return [
                'id' => $item->id,
                'parentEmail' => $item->email,
                'amount' => $item->balance,
                'currency' => $item->currency,
                'status' => self::$statusCodes[$item->status],
                'created_at' => $item->created_at,
            ];
        }, $data));
    }
}
