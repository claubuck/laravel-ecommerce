<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cashFlow extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'closing_cash',
        'sales',
        'closed',
        'inicio',
        'fin',
    ];
}
