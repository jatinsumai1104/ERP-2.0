<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class MailConfigHelper
{
    public static function getMailer(): PHPMailer
    {
        $mail = new PHPMailer();
        $mail->SMTPDebug = 2;                   // Enable verbose debug output
        $mail->isSMTP();                        // Set mailer to use SMTP
        $mail->Host = 'smtp.gfg.com;';    // Specify main SMTP server
        $mail->SMTPAuth = true;               // Enable SMTP authentication
        $mail->Username = 'user@gfg.com';     // SMTP username
        $mail->Password = 'password';         // SMTP password
        $mail->SMTPSecure = 'tls';              // Enable TLS encryption, 'ssl' also accepted
        $mail->Port = 587;                // TCP port to connect to    }
        $mail->setFrom('from@gfg.com', 'Name');           // Set sender of the mail
        return $mail;
    }


}