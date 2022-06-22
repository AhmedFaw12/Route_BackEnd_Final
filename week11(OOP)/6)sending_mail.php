<?php
/*
    -we want our application to send mail
    -php has built-in function call mail() but need modifications
    -so instead of making modification from zero ,there are external libraries we can use , such as PHPMailer 
    -steps to use external libraries:
        -search for PHPMailer
        -enter github link , read documentation
        - clone the package/library :git clone https://github.com/PHPMailer/PHPMailer.git 

        - we only need some files in src folder : 
            -Exception.php
            -PHPMailer.php
            -SMTP.php 
        
        -in documentation copy this require code to our project  and change the path: 
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

            require 'path/to/PHPMailer/src/Exception.php';
            require 'path/to/PHPMailer/src/PHPMailer.php';
            require 'path/to/PHPMailer/src/SMTP.php';

        -in documentation copy this code to our project :
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'user@example.com';                     //SMTP username
                $mail->Password   = 'secret';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
                $mail->addAddress('ellen@example.com');               //Name is optional
                $mail->addReplyTo('info@example.com', 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');

                //Attachments
                $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

///////////////////////////////////////////////////////////////////////
        -since we don't have real host to be used as mail server , we will free website(mailtraip.io) gives us(act as) fake/dummy SMTP server.

        -choose what will we use mailtrap with , so we will use PHPMailer , copy the code , then replace old server settings but change variable name 

        - in Recipients:
          -we will write who will send the email (setFrom("Ahmed@gmail.com", 'ahmed'))
          -we will also write to whom the email will be send(addAddress())
          example : in contact us , login email(client) will send to the site

          -we can also send attachments but the attachments must be on server then send the link
          -we can also addcc , addBCC
          -we can also change subject, body
          -body is written in html
        
        -since we use MailTrap , all emails are sent to mailtrap since we are testing

        -we need to change port=2525 since it is blocked, we will use port=587 which is another port used for smtp

    
    
    -we use SMTP (Simple Mail Transfer Protocol) to send Email by our application
            
    -in our project , if user forgot password , we want to send email to user to make a new password
    -also in contact us , we send email to ourselves
       
    -POP3 is another protocol(if i want to make mailbox : send and receive emails like gmail)
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->Username = '6538f0b6ea0296';
    $mail->Password = 'bdf37901b8b7c2';

    //Recipients
    $mail->setFrom('Ahmedfawdw12@gmail.com', 'Ahmed');
    $mail->addAddress('Ahmedfawzyaf97@gmail.com', 'Ahmed2');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Hello from Ahmed 1';
    $mail->Body    = 'Welcome';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}