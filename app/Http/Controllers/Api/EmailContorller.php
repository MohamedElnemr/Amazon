<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;
use App\Http\Request\EmailRequest;
class EmailContorller extends Controller
{
    public function sentConfirem()
    {
        $data = [
            'username'=>'eelbarshly@gmail.com',
            'massage'=>'The Request Arrived Sir Check it'
        ];
        ConfirmMail::dispatch($data);
       

    }

    public function sentDetalis()
    {
        $datea = ["Dear:"=>"User","message"=>"The Request Has Been Received"];
       Mail::send('Html.view', $data, function ($message) {
           $message->from('Admin @johndoe.com', 'John Doe'); // who sent mail
        //    $message->sender('john@johndoe.com', 'John Doe');
           $message->to('eelbarshly@gmail.com', 'Elsaed Elbarshly');
        //    $message->cc('john@johndoe.com', 'John Doe');
        //    $message->bcc('john@johndoe.com', 'John Doe');
        //    $message->replyTo('john@johndoe.com', 'John Doe');
           $message->subject('The Request Detalis'); 
        //    $message->priority(3);  //int the que
        //    $message->attach('pathToFile');
       });
    }
}
