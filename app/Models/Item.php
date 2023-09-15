<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Purchase;

class Item extends Model
{
    // このuseがないとfactory()が使用できない
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'memo',
        'price',
        'is_selling',
    ];


    public function purchases()
    {
        return $this->belongsToMany(Purchase::class)->withPivot('quantity');
    }
}
