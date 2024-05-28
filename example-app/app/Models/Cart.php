<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'shopping__cart';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
        'image'
    ];
}
