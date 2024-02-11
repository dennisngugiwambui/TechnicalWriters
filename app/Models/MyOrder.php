<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyOrder extends Model
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


    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderId');
    }
}
