<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// here are all Parameaters
// **$Username 
// **$Password
// **$Host  
// **$SMTPSecure
// **$Port 
// **$setFrom
// **$setform +$name_of_user
// **for how(s) type array used mit foreach 
// **$Subject
// **$Body
// **$AltBody (if user has no html in mail it's alternative text)
// **$isHTML()boolean
// **
//end all parameters
function mailing($recivers,$Body){
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
//Load Composer's autoloader
require 'vendor/autoload.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
//Server settings
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'saifxt0000@gmail.com';                 //SMTP username
$mail->Password   = '49a227bea@t';                          //SMTP password
$mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    
    //Recipients
    $mail->SetFrom('donotreply@mydomain.com', 'Admin');

    foreach ($recivers as $resiver ){
        // if(empty($name)){$name="User";}
     $mail->addAddress($resiver);     //Add a recipient
    }
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');



    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = $Body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    //massage after send to Get Error
    return 'Message has been sent';
    } catch (Exception $e) {
    return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


//end function
}