<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Subtotal;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        // スコープを使用するときにはお決まりのやつ。使用するスコープモデルを指定する。
        static::addGlobalScope(new Subtotal);
    }

    public function scopeBetweenDate($query, $startDate = null, $endDate = null)
    {
        if(is_null($startDate) && !is_null($endDate)) {
            $endDate1 = Carbon::parse($endDate)->addDays(1);
            return $query->where('created_at', '<=', $endDate1);
        }

        if(!is_null($startDate) && !is_null($endDate)) {
            $endDate1 = Carbon::parse($endDate)->addDays(1);
            return $query->where('created_at', ">=", $startDate)
            ->where('created_at', '<=', $endDate1);
        }
    }
}
