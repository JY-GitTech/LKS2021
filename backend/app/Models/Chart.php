<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'produk_id', 'qty', 'harga', 'total_harga'
    ];

    public function User(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function Produk(){
        return $this->hasMany(Produk::class, 'id', 'produk_id');
    }
}
