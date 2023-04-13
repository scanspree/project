<?php

include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function resetmail($email,$reset_token)
{
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'scanspree08@gmail.com';                     //SMTP username
        $mail->Password   = 'vpcdajbqmedabphx';                               //SMTP password
        $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
        $mail->Port       = 587;                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('scanspree08@gmail.com');
        $mail->addAddress($email);     //Add a recipient
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password reset link';
        $mail->Body    = "We got a request from you to reset your password <br> Click the link below:<br>
          <a href='https://scanspree.shop/updatepassword.php?email=$email&reset_token=$reset_token'>Reset password</a>";
        
    
        $mail->send();
        //echo "<script>alert('sended');</script>";
        return true;
      } catch (Exception $e) {
        echo "<script>alert('exc');</script>";
        return false;
    }
}

if(isset($_POST['reset']))
{
    $sql = "SELECT * FROM `customer_login` WHERE `email`='$_POST[email]'";
    $result = $conn->query($sql);
    if ($result == true)
    {
        
        if ($result->num_rows == 1)
        {
            $reset_token = bin2hex(random_bytes(8));
           date_default_timezone_set('Asia/kolkata');
           $date = date("y-m-d");
           $upquery = "UPDATE `customer_login` SET `resettoken`='$reset_token', `resettokenexpire`='$date' where `email`='$_POST[email]'";
           $upresult = $conn->query($upquery);
           if($upresult == true && resetmail($_POST['email'],$reset_token))
           {
            echo "<script>
            alert('Password reset link sent');
            window.location.href='login.php';
            </script>";
           }
           else
           {
            echo "<script>
            alert('Cannot run query');
            window.location.href='login.php';
            </script>";
           }
        }
        else
        {
            echo "<script>
            alert('Cannot find email');
            window.location.href='login.php';
            </script>";
        }
    }
    else
    {
        echo "<script>
        alert('Cannot run query');
        window.location.href='login.php';
        </script>";
    }
}

?>