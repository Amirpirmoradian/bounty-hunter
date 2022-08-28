<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'customer_id',
        'seller_id',
        'order_total',
        'cleared',
    ];


    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }


    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    
}
