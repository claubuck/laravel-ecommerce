<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saleDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'price',
        'discount',
        
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function sales(){
        return $this->belongsTo(Sale::class);
    }
}
