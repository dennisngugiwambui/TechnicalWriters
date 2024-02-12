<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;


class WriterController extends Controller
{
    public function sendSms(string $number, string $message)
    {
        $username = 'dennohosi'; // use 'sandbox' for development in the test environment
        $apiKey   =  getenv('AT_API_KEY'); // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);


        // Get one of the services
        $sms      = $AT->sms();


        // Use the service
        $result   = $sms->send([
            'to'      => $number,
            'message' => $message,
        ]);


    }

}
