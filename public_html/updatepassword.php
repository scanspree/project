<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    
    <link rel="stylesheet" href="css/bootstrap.min.css"><!--remove line-->
    
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Harmattan&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Password update</title>
    <script>
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Harmattan&display=swap');
    </style>
    <style>
        <?php include "style1.css" ?>
    </style>
</head>

<body>
    <?php
    include("connection.php");

    if (isset($_GET['email']) && isset($_GET['reset_token'])) {
        date_default_timezone_set('Asia/kolkata');
        $date = date("y-m-d");
        $sql = "SELECT * FROM `customer_login` WHERE `email`='$_GET[email]' AND `resettoken`='$_GET[reset_token]' AND `resettokenexpire`='$date'";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            if ($result->num_rows == 1) {
                echo "
        <a class='back' id='back' href='login.php' name='back' type='button' ><span class='material-symbols-rounded'>keyboard_backspace
        </span></a>

        <h2>
        <div class='row justify-content-center mt-3'>Reset password</div>
        </h2>

        <div class='container-fluid fixed-bottom' style='height: 80%;'>
        <div class='container align-items-center'><br><br>

        <form method='POST' action='updatepassword.php' name='updateform' onsubmit='return validate();'>

        <div class='row justify-content-center' id='row1'>
        <div class='col-1 p-4'></div>
          <div class='col-9' id='cl'>
            <div class='mb-2 mt-2'>
              <div class='input_group'>
              <span class='material-symbols-rounded p-1'>vpn_key</span>
                <input class='col-9' type='password' id='password' name='password' placeholder='Password' required>
              <span class='material-symbols-rounded' onclick='toggle();' id='eyeicon'>visibility_off</span>
              </div>  
            </div>
          </div>
          <div class='col-1'></div>
        </div>

        <input type='hidden' class='form-control' id='email' name='email' value='$_GET[email]'>

        <div class='row' id='row1'>
          <div class='col-1'></div>
          <div class='col-10' id='cl'>
            <div class='mb-2 mt-2'>
              <div class='input_group'>
              <span class='material-symbols-rounded p-1'>verified</span>
                <input type='password' id='repassword' name='repassword' placeholder='Confirm Password' required>
              </div>
            </div>
          </div>
          <div class='col-1'></div>

          <div class='row mt-3 fixed-bottom'>
                    <div class='col-3'></div>
                    <div class='text-center d-grid col-12 p-5' id='col1'>
                        <input class='btn btn-outline-dark' type='submit' id='btn' href='#' type='button' name='update' value='RESET' style='font-weight: bold'>
                    </div>
                    <div class='col-3'></div>
                </div>
            
            </form>

            
            </div>
            ";

            } else {
                echo "<script>
            alert('Invalid or expired link');
            window.location.href='login.php';
            </script>";
            }
        } else {
            echo "<script>
        alert('cannot run query');
        window.location.href='login.php';
        </script>";
        }
    }

    ?>

<?php

if(isset($_POST['update'])){
    $pass=password_hash($_POST['password'],PASSWORD_BCRYPT);
    $update="UPDATE `customer_login` SET `password`='$pass', `resettoken`=NULL,`resettokenexpire`=NULL WHERE `email`='$_POST[email]'";
    $result=$conn->query($update);
    if ($result == TRUE)
    {
        echo "<script>
        alert('Password Updated Successfully');
        window.location.href='login.php';
        </script>";

    }
    else{
        echo "<script>
        alert('cannot run query');
        window.location.href='login.php';
        </script>";
    }
}
?>

<script>
    function validate() {
      var pass = document.updateform.password.value;
      var conpass = document.updateform.repassword.value;
      if (pass.length < 8) {
        alert("Password should be of atleat 8 characters");
        return false;
      }

      if (pass != conpass) {
        alert("password is not similar");
        return false;
      }
    }

</script>
</body>

</html>