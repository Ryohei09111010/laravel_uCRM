<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $fillable = ['name','kana','tel','email','postcode','address', 'birthday','gender', 'memo'];

    // ローカルスコープを使用する際はメソッド名はscopeから始める
    public function scopeSearchCustomers($query, $input = null)
    {
        if(!empty($input)){
            if(Customer::where('kana', 'like', $input . '%' )
                        ->orWhere('tel', 'like', $input . '%')->exists()){
                return $query->where('kana', 'like', $input . '%' )
                        ->orWhere('tel', 'like', $input . '%');
            }
        }
    }
}
