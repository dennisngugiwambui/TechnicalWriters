<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected  $fillable = [
        'from',
        'from_phone',
        'from_email',
        'to',
        'to_phone',
        'to_email',
        'title',
        'date',
        'message',
        'visible',
        'read_status',
        'permission',

    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderId');
    }
}
