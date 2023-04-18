<?php
include("connection.php");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $v_code)
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
    $mail->Subject = 'Email verification from ScanSpree';
    $mail->Body    = "Thanks for registration
    click the link below to verify the email address
    <a href='https://scanspree.shop/verify.php?email=$email&v_code=$v_code'>verify</a>";


    $mail->send();
    echo "<script>alert('Check your mail to verify your account');</script>";
    return true;
  } catch (Exception $e) {
    echo "<script>alert('exc');</script>";
    return false;
  }
}


if (isset($_POST['submit'])) {
  $check_query = "SELECT * FROM `customer_login` WHERE `email` = '$_POST[email]' OR `contact` = '$_POST[contact]'";
  $result2 = $conn->query($check_query);
 // echo "1";
  if ($result2 == TRUE) {
  //  echo "2";
    if ($result2->num_rows > 0) {
   //   echo "3";
      $row = $result2->fetch_assoc();
   //   echo "4";
      if ($row['contact'] == $_POST['contact'] || $row['email'] == $_POST['email']) {
     //   echo "5";
        echo "
        <script>
        alert('Email/Phone Number already exists');
        window.location.href='reg.php';
        </script>
        ";
      }
    } else {
     // echo "7";
      $username = $_POST['username'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

      $v_code = bin2hex(random_bytes(8));
      $sql = "INSERT INTO `customer_login`(`username`, `email`, `contact`, `password`, `ver_code`, `is_verified`) VALUES ('$username','$email',$contact,'$password','$v_code','0')";

      $result = $conn->query($sql); //fire query
      $semail = sendMail($email, $v_code);

      if ($result == TRUE && $semail == true) {
        echo "
        <script>
        
        window.location.href='login.php';
        </script>";
      } else {
        echo "error: " . $sql . "<br>" . $conn->error;
      }
    }
  } else {
    echo "<script>
    alert('Cannot run query');
    window.location.href='reg.php';
    </script>";
  }


  $conn->close();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style1.css">
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet">
  <script src="js/bootstrap.js"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Harmattan&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Harmattan&display=swap');
  </style>
  <style>
    <?php include "style1.css" ?>
  </style>
</head>

<body>


  <a class="back" id="back" href="homepg.php" name="back" type="button" ><span class="material-symbols-rounded">keyboard_backspace
</span></a>

  <h2>
    <div class="row justify-content-center mt-3">Create your account</div>
  </h2>



  <div class="container-fluid fixed-bottom" style="height: 80%;">

    <div class="container align-items-center"><br><br>

      <form method="POST" action="reg.php" name="regform" onsubmit="return validate();">
        <div class="row" id="row1">
          <div class="col-1"></div>
          <div class="col-9" id="cl">
            <div class="mb-2 mt-3">
              <div class="input_group">
              <span class="material-symbols-rounded p-1">account_circle</span>
                <input type="text" id="username" name="username" placeholder="Username" required >                
              </div>
            </div>
          </div>
          <div class="col-1"></div>
        </div>

        <div class="row align-items-center" id="row1">
          <div class="col-1"></div>
          <div class="col-9" id="cl">
            <div class="mb-2 mt-2">
              <div class="input_group">
              <span class="material-symbols-rounded p-1">mail</span>
                <input type="text" id="email" name="email" placeholder="Email" required>
              </div>
            </div>
          </div>
          <div class="col-1"></div>
        </div>



        <div class="row" id="row1">
          <div class="col-1"></div>
          <div class="col-9" id="cl">
            <div class="mb-2 mt-2">
              <div class="input_group">
              <span class="material-symbols-rounded p-1">call</span>
                <input type="text" id="contact" name="contact" placeholder="Phone Number" required>
              </div>
            </div>
          </div>
          <div class="col-1"></div>
        </div>


        <div class="row " id="row1">
        <div class="col-1"></div>
          <div class="col-10" id="cl">
            <div class="mb-2 mt-2">
              <div class="input_group">
              <span class="material-symbols-rounded p-1">vpn_key</span>
                <input class="col-9" type="password" id="password" name="password" placeholder="Password" required>
              <span class="material-symbols-rounded" onclick="toggle();" id="eyeicon">visibility_off</span>
              </div>  
            </div>
          </div>
          <div class="col-1"></div>
        </div>

        <div class="row" id="row1">
          <div class="col-1"></div>
          <div class="col-9" id="cl">
            <div class="mb-2 mt-2">
              <div class="input_group">
              <span class="material-symbols-rounded p-1">verified</span>
                <input type="password" id="repassword" name="repassword" placeholder="Confirm Password" required>
              </div>
            </div>
          </div>
          <div class="col-1"></div>

        </div>
        <br>

        <!--

        <div class="row mt-2 " id="row3">
          <div class="col-1">
            <h6 class="mb-2 pb-1">Gender: </h6>
          </div>

          <div class="col">

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" value="male" id="male" required>
              <label class="form-check-label" for="male">
                Male
              </label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" value="female" id="female">
              <label class="form-check-label" for="female">
                Female
              </label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" value="others" id="others">
              <label class="form-check-label" for="others">
                Others
              </label>
            </div>

          </div>
          <div class="col-6">
            <div class="form-floating mb-3 mt-3">
              <input type="date" class="form-control" id="dob" name="dob" placeholder="dob" required>
              <label for="contact">Date of birth</label>
            </div>
          </div>
-->

        <div class="row mt-3 fixed-bottom">
          <div class="col-3 "></div>
          <div class="text-center d-grid col-12 p-5" id="col1">
         <input class="btn btn-outline-dark" type="submit" id="btn" href="#" type="button" name="submit" value="SUBMIT" style="font-weight: bold">
          </div>
          <div class="col-3"></div>
        </div>
      </form>

    </div>
  </div>

  <script>
    function validate() {
      var pass = document.regform.password.value;
      var conpass = document.regform.repassword.value;
      if (pass.length < 8) {
        alert("Password should be of atleat 8 characters");
        return false;
      }

      if (pass != conpass) {
        alert("password is not similar");
        return false;
      }



      var a = document.regform.email.value;
      var atpos = a.indexOf("@");
      var dotpos = a.lastIndexOf(".");
      if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= a.length) {
        alert("Enter valid email");
        return false;
      }

      var z = document.regform.contact.value;
      if (z.length != 10 || z == "" || isNaN(z)) {
        alert("Enter valid contact numbers");
        return false;
      }
    }
    /*var age = getAge(document.regform.dob.value);
     if (age < 18) {
       alert("you are not 18+");
       return false;*/

    /*
          function getAge(dateString) {
            var today = new Date(),
              birthDate = new Date(dateString),
              age = today.getFullYear() - birthDate.getFullYear(),
              m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
              age--;
            }
            return age;
          }
        }*/

    function toggle() {
      var x = document.getElementById("password");
      var y = document.getElementById("repassword");
      const visibilityToggle = document.getElementById("eyeicon");
    
      if (x.type == "password" && y.type == "password") {
        x.type = "text";
        y.type = "text";
        visibilityToggle.innerHTML = '<span class="material-symbols-rounded">visibility</span>';
      } else {
       x.type = "password";
        y.type = "password";
        visibilityToggle.innerHTML = '<span class="material-symbols-rounded">visibility_off</span>';
      }
    }
  </script>
</body>

</html>