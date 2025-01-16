<?php

namespace App\Models;

use App\Helpers\General;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $guarded = ["id"];

    const ORDERCODE = 'ORD';

    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderCode()
    {
        $dateCode = self::ORDERCODE . '-' . date('Ymd') . '-' . General::integerToRoman(date('m')) . '-' . General::integerToRoman(date('d')) . '-';

        $lastOrder = self::select([DB::raw('MAX(orders.code) AS last_code')])
            ->where('code', 'like', $dateCode . '%')
            ->first();

        $lastOrderCode = !empty($lastOrder) ? $lastOrder['last_code'] : null;

        $orderCode = $dateCode . '00001';
        if ($lastOrderCode) {
            $lastOrderNumber = str_replace($dateCode, '', $lastOrderCode);
            $nextOrderNumber = sprintf('%05d', (int)$lastOrderNumber + 1);

            $orderCode = $dateCode . $nextOrderNumber;
        }

        if (self::_isOrderCodeExists($orderCode)) {
            return self::generateCode();
        }

        return $orderCode;
    }

    private static function _isOrderCodeExists($orderCode)
    {
        return Order::where('code', '=', $orderCode)->exists();
    }
}
