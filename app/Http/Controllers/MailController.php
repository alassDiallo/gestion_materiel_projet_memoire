<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function basic_email() {
        $data = array('name'=>"Assane");
     
        Mail::send(['text'=>'mail'], $data, function($message) {
           $message->to('alassdiallo58@gmail.com', 'send mail')->subject
              ('Testing laravel send mail');
           $message->from('azoistar10@gmail.com','Assane Diallo');
        });
        dd("Basic Email Sent. Check your inbox.");
     }
}
