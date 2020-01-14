<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$path = __DIR__;
require_once("{$path}/../../vendor/autoload.php");

class MailConfigHelper
{
    
    
   
    
    public static function getMailer(): PHPMailer
    {
        
        $path = __DIR__;
        //Getting all the email smtp info in the array
        $email_details = parse_ini_file("{$path}/../../config.ini");


        $mail = new PHPMailer();
        $mail->SMTPDebug = $email_details['SMTPDebug'];                   // Enable verbose debug output
        $mail->isSMTP();                        // Set mailer to use SMTP
        $mail->Host = $email_details['email_host'];    // Specify main SMTP server
        $mail->SMTPAuth = $email_details['SMTPAuth'];               // Enable SMTP authentication
        $mail->Username = $email_details['email_username'];     // SMTP username
        $mail->Password = $email_details['email_password'];         // SMTP password
        $mail->SMTPSecure = $email_details['SMTPSecure'];              // Enable TLS encryption, 'ssl' also accepted
        $mail->Port = $email_details['Port'];                // TCP port to connect to    }
        $mail->setFrom($email_details['email_from'], $email_details['name']);           // Set sender of the mail
        return $mail;
    }


}