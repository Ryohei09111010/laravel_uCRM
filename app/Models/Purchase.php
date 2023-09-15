<?php

namespace App\Models;

use app\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Purchase extends Model
{
    // このuseがないとfactory()が使用できない
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status',
        ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function items()
    {
        // 中間テーブルのカラムを取得するにはwithPivotを指定する
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }
}
