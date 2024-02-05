<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function orders()
    {
        $order = new Order();

        $order-> orderId= $request-> orderId;
        $order-> taskSize= $request-> taskSize;
        $order-> title= $request-> title;
        $order-> description= $request-> description;
        $order-> word_count= $request-> word_count;
        $order-> price= $request-> price;
        $order-> visible= $request-> visible;
        $order-> deadline= $request-> deadline;
        $order-> comments= $request-> comments;
        $order-> file= $request-> file;
        $order-> writer_id= 'N/A'

        $order->save();

    }
}
