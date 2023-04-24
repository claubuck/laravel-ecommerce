<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'stock',
        'description',
        'image',
        'sell_price',
        'status',

    ];

    public function saleDetails(){
        return $this->hasMany(saleDetail::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
