<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function available()
    {
        return $this->hasOne(Available::class, 'OrderId');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'OrderId');
    }

    public function myOrder()
    {
        return $this->hasOne(MyOrder::class, 'OrderId');
    }
}
