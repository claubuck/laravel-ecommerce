<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_date',
        'tax',
        'total',
        'status',
        
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function saleDetails(){
        return $this->hasMany(saleDetail::class);
    }
}
