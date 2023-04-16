<?php
include("connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$v_code)
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
      <a href='https://scanspree.shop/Scanspree/Admin/verify.php?email=$email&v_code=$v_code'>verify</a>";
    

    $mail->send();
    echo "<script>alert('sended');</script>";
    return true;
  } catch (Exception $e) {
    echo "<script>alert('exc');</script>";
    return false;
}
  
}


if (isset($_POST['submit'])) {
  $check_query = "SELECT * FROM `admin_login` WHERE  `email` = '$_POST[email]'";
  $result2 = $conn->query($check_query);
  echo "1";
  if ($result2 == TRUE) {
    echo "2";
    if ($result2->num_rows > 0) {
      echo "3";
      $row = $result2->fetch_assoc();
        echo "4";
      if($row['username']==$_POST['username']||$row['email']==$_POST['email']){
        echo "5";
        echo "
        <script>
        alert(' email already exists');
        window.location.href='reg.php';
        </script>
        ";
      }
    }else{
      echo "7";
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $name = $fname . " " . $lname;
      $email = $_POST['email'];
      $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
      $v_code = bin2hex(random_bytes(8));

      $sql="INSERT INTO `admin_login`( `name`, `email`, `password`, `ver_code`, `is_verified`) VALUES  ('$name','$email','$password','$v_code','0')";
    
      $result = $conn->query($sql); //fire query
      $semail = sendMail($email,$v_code);
    
      if ($result == TRUE && $semail == true) {
        echo "
        <script>
        alert('Registration Successful');
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
    </script>" 
    ;
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
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="style1.css">
  <script src="js/bootstrap.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Harmattan&display=swap" rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Harmattan&display=swap');
</style>

<body>

  <nav class="navbar vh-15 mt-3">
    <div class="container col-sm-1 justify-content-center">
      <a class="navbar-brand" id="logo" href="#">
        <img src="Images/logo2.svg" alt="ScanSpree" width="500" height="120" class="d-inline-block align-text-top">
      </a>
    </div>
  </nav>
  <div class="container-fluid fixed-bottom" style="height: 80%;">
    <div class="container align-items-center">
      <div class="container">

        <h2>
          <div class="row justify-content-center mt-4">Admin Registration</div>
        </h2>
        <form method="POST" action="reg.php" name="regform" onsubmit="return validate();">
          <div class="row" id="row1">
            <div class="col">
              <div class="mb-3 mt-3">
                <div class="input_group">
                  <span class="material-symbols-rounded p-1">account_circle</span>
                  <input class="col-11" type="text" id="username" name="username" placeholder="Name" required>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="mb-3 mt-3">
                <div class="input_group">
                  <span class="material-symbols-rounded p-1">mail</span>
                  <input class="col-11" type="text" id="email" name="email" placeholder="Email" required>
                </div>
              </div>
            </div>
          </div>

          <div class="row" id="row2">
            <div class="col">
              <div class="mb-3 mt-3">
                <div class="input_group">
                  <span class="material-symbols-rounded p-1">vpn_key</span>
                  <input class="col-10" type="password" id="password" name="password" placeholder="Password" required>
                  <span class="material-symbols-rounded" onclick="toggle();" id="eyeicon">visibility_off</span>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="mb-3 mt-3">
                <div class="input_group">
                  <span class="material-symbols-rounded p-1">verified</span>
                  <input class="col-10" type="password" id="repassword" name="repassword" placeholder="Confirm Password"
                    required>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-3 mb-5 fixed-bottom">
            <div class="col-4"></div>

            <div class="text-center d-grid gap-2 col-4 p-5" id="col1">
              <button class="btn btn-outline-dark" href="homepg.php" type="button"><b>BACK</b></button>
              <input class="btn btn-outline-dark" type="submit" id="btn" href="#" type="button" name="submit"
                value="SUBMIT" style="font-weight: bold">
            </div>
            <div class="col-4"></div>

          </div>
        </form>
      </div>
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
    }

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