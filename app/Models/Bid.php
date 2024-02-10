<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderId');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id'); // Assuming 'writer_id' is the column in bids table
    }
}
