<?php
include("connection.php");
session_start();

if (isset($_POST['login'])) {
    $sql = "SELECT * FROM  `admin_login` WHERE `email`='$_POST[username]'";
    $result = $conn->query($sql);
    if ($result == true) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($row['is_verified'] == 1) {
                if (password_verify($_POST['password'], $row['password'])) {
                    $_SESSION['logged_in'] = TRUE;
                    $_SESSION['username'] = $row['email'];
                    header("location: dash.php");
                } else {
                    echo "<script>
                    alert('Password incorrect');
                    window.location.href='login.php';
                    </script>";
                }
            } else {
                echo "<script>
                alert('Email not verified');
                window.location.href='login.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Email/username not registered');
            window.location.href='login.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Cannot run query');
        window.location.href='login.php';
        </script>";
    }
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Harmattan&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Harmattan&display=swap');
  </style>
<body>

    <nav class="navbar vh-15 mt-3">
        <div class="container col-sm-1 justify-content-center">
            <a class="navbar-brand" id="logo" href="#">
                <img src="images/ss.png" alt="ScanSpree" width="300" height="120" class="d-inline-block align-text-top">
            </a>
        </div>       
    </nav>

    <div class="container">
        <h2>
            <div class="row justify-content-center mt-3">Admin Login</div>
        </h2>

            <form method="POST" action="" name="logform">
                <div class="row" id="row1">
                    <div class="col">
                        <div class="mb-3 mt-3">
                        <div class="input_group">
                            <span class="material-symbols-rounded p-1">mail</span>
                            <input class="col-11" type="text" id="username" name="username" placeholder="Email" required>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="row3">
                    <div class="col">
                        <div class="mb-3 mt-3">
                        <div class="input_group">
                            <span class="material-symbols-rounded p-1">vpn_key</span>
                                <input class="col-11" type="password" id="password" name="password" placeholder="Password" required>
                                <span class="material-symbols-rounded" onclick="toggle();" id="eyeicon">visibility_off</span>
                            </div>  
                            <a class="fp" href="#" data-bs-toggle="modal" data-bs-target="#myModal">Forgot password?</a>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-5 fixed-bottom">
          <div class="col-4 "></div>
            <div class="text-center d-grid gap-2 col-4 p-5" id="col1">
            <button class="btn btn-outline-dark"  href="homepg.php" type="button"><b>BACK</b></button>
              <input class="btn btn-outline-dark" type="submit" id="btn" href="#" type="button" name="login" value="LOGIN" style="font-weight: bold">
            </div>
          <div class="col-4"></div>
        </div>

            </form>
    </div>


    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reset Password</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="forgotpassword.php">
                        <div class="mb-3">
                            <label for="email" class="col-form-label" required>Enter Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="reset" class="btn btn-warning">Send Link</button>
                </div>
                </form>
            </div>
        </div>
    </div>




    <script>
       function toggle() {
      var x = document.getElementById("password");
      const visibilityToggle = document.getElementById("eyeicon");
    
      if (x.type == "password") {
        x.type = "text";
        visibilityToggle.innerHTML = '<span class="material-symbols-rounded">visibility</span>';
      } else {
       x.type = "password";
        visibilityToggle.innerHTML = '<span class="material-symbols-rounded">visibility_off</span>';
      }
    }
    </script>

</body>

</html>