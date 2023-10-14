<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'user_city',
        'sale_id',
        'status',
        'total',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
