<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function send($to, $subject, $body)
    {
        $mail = new PHPMailer;
        $mail->isHTML(true); 
        // ... configure SMTP settings and other options
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'tbkb.batangkapas@gmail.com';                 // SMTP username
        $mail->Password = 'lxbrhnrvilfqfdcs';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
        $mail->setFrom('tbkb.batangkapas@gmail.com');

        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        return $mail->send();
    }
}
