<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// pour connecter a la base de données

// Instantiation and passing `true` enables exceptions

if(isset($_POST["email"])) {

    $emailTo = $_POST["email"];

    $code = uniqid(true);
    $query = $con->query("INSERT INTO pwd_Reset (code, email)
    VALUES ('$code', '$emailTo')");

          if(!$query) {
              exit("Error");
          }                       
    $mail = new PHPMailer(true);

try {
    //Server settings
    
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'chillix.becode@gmail.com';                     // SMTP username
    $mail->Password   = 'beCodeBxl';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('chillix.becode@gmail.com', 'Chillix');
    $mail->addAddress("$emailTo");     // Add a recipient
    $mail->addReplyTo('no-reply@gmail.com', 'No reply');
    

    // Content
    $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code";
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = "<div><h1>You requested a password reset</h1><p>Click<a href='$url'> this link </a> to do so</p></div>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'reset passwordlink has been sent to your email';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}   exit();

}
// pour resetPassword

if(!isset($_GET["code"])) {
    exit("Can't find the page");
   } else {
       $code = $_GET["code"];
   }
   
   
   $getEmailQuery = $con->query("SELECT * FROM pwd_Reset WHERE code='$code'");
   $result = $getEmailQuery->fetch(PDO::FETCH_ASSOC);
   
   
   
   if(isset($_POST["password"])) {
       $pw = $_POST["password"];
       $pw = hash("sha512", $pw);
   
       $email = $result["email"];   
   
       echo $email . "<br>";
       $query = $con->query("UPDATE users SET password='$pw' WHERE email='$email'"); 
   
       
             if($query) {
               $query = $con->query("DELETE FROM pwd_Reset WHERE code='$code'");
               exit("Password updated");
             }  
             else{
               exit("Error");
             }                     
   
       //if($result->rowCount() != 0) {
         //  exit("Can't find the page");
       //}
      }