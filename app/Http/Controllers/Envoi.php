<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailerPHPMailerPHPMailer;
use PHPMailerPHPMailerException;

class Envoi extends Controller
{
        public function sendEmail (Request $request) {
          
          // is method a POST ?
    
                require '../vendor/autoload.php'; // load Composer's autoloader
    
            $mail = new PHPMailer(true); // Passing `true` enables exceptions
    
                try {
    
                    // Mail server settings
    
                    $mail->SMTPDebug = 4; // Enable verbose debug output
                    $mail->isSMTP(); // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true; // Enable SMTP authentication
                    $mail->Username = 'azoistar10@gmail.com'; // SMTP username
                    $mail->Password = 'dimaria11'; // SMTP password
                    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587; // TCP port to connect to
    
                    $mail->setFrom('azoistar10@gmail.com', 'Assane Diallo');
                    $mail->addAddress("alassdiallo58@gmail.com"); // Add a recipient, Name is optional
                    $mail->addCC("bonjour");
                    $mail->addBCC("comment tu vas");
                    $mail->addReplyTo('azoistar10@gmail.com', 'Assane Diallo');
                    // print_r($_FILES['file']); exit;
    
                    for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
                        $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]); // Optional name
                    }
    
                    $mail->isHTML(true); // Set email format to HTML
    
                    $mail->Subject = "essai";
                    $mail->Body    = "salut comment tu vas";
                    // $mail->AltBody = plain text version of your message;
    
                    if( !$mail->send() ) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        echo 'Message has been sent';
                    }
    
                } catch (Exception $e) {
                    // return back()->with('error','Message could not be sent.');
                }
            }
      }
    
