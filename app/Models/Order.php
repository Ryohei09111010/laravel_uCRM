<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Subtotal;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        // スコープを使用するときにはお決まりのやつ。使用するスコープモデルを指定する。
        static::addGlobalScope(new Subtotal);
    }
}
