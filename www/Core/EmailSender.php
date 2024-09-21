<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '/var/www/html/administrator/php/vendor/autoload.php';

class EmailSender {

  function send_email($receiver, $receiver_name,  $subject, $body_string){

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'beggararezki@gmail.com';                     
    $mail->Password   = 'cspu jpcj kssk wfsf';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;

    $mail->setFrom('beggararezki@gmail.com', 'Arezki BEGGAR');
    $mail->addAddress($receiver, $receiver_name);     

    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body    = $body_string;  

    if (!$mail->send()) {
        
        return 0;
    } else {
        
        return 1;
    }
  }

}
  



?>