<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
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

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderId', 'id');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id'); // Assuming 'writer_id' is the column in bids table
    }
    public function available()
    {
        return $this->belongsTo(Available::class, 'OrderId', 'id');
    }
}
