<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Files;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'OrderId',
        'assignmentType',
        'typeOfService',
        'topicTitle',
        'discipline',
        'pages',
        'deadline',
        'cpp',
        'price',
        'comments',
        'files',
        'writer_id',
        'writer_name',
        'writer_phone',
        'status',


    ];

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

    public function messages()
    {
        return $this->hasMany(Message::class, 'OrderId');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'OrderId');
    }
    public function files()
    {
        return $this->hasMany(Files::class);
    }
}
