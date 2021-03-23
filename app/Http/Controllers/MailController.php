<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function basic_email() {
    
         $data = array('name'=>"Modou");
      
         Mail::send(['text'=>'email'], $data, function($message) {
            $message->to('alassdiallo58@gmail.com', 'send mail')->subject
               ('Testing laravel send mail');
            $message->from('azoistart10@gmail.com','Assane Diallo');
         });
         echo "Basic Email Sent. Check your inbox.";
      }
   
}
