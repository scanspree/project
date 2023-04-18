<?php
include("connection.php");
session_start();

if (isset($_POST['login'])) {
    $sql = "SELECT * FROM `customer_login` WHERE `email`='$_POST[username]' OR `contact`='$_POST[username]'";
    $result = $conn->query($sql);
    if ($result == true) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($row['is_verified'] == 1) {
                if (password_verify($_POST['password'], $row['password'])) {
                    $_SESSION['logged_in'] = TRUE;
                    $_SESSION['username'] = $row['username'];
                    header("location: scanpg.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Harmattan&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
        <div class="row justify-content-center mt-3">Login to your account</div>
    </h2>

    <div class="container-fluid fixed-bottom" style="height: 80%;">

        <div class="container">
        <br><br>    
        <form method="POST" action="" name="logform">
                <div class="row" id="row1">
                    <div class="col-1"></div>
                    <div class="col-9" id="cl">
                        <div class="mb-3 mt-3">
                            <div class="input_group">
                            <span class="material-symbols-rounded p-1">mail</span>
                                <input type="text" id="username" name="username" placeholder="Email or Phone Number" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>

                <div class="row" id="row1">
                    <div class="col-1"></div>
                    <div class="col-9" id="cl">
                        <div class="mb-3 mt-3">
                            <div class="input_group">
                            <span class="material-symbols-rounded p-1">vpn_key</span>
                                <input type="password" id="password" name="password" placeholder="Password" required>
                                <span class="material-symbols-rounded" onclick="toggle();" id="eyeicon">visibility_off</span>
                            </div>  
                            <div class="row" id="row1">
                    <div class="col-1"></div>
                    <div class="col-10" id="f">
                    <div>
                <a class="fp" href="#" data-bs-toggle="modal" data-bs-target="#myModal">
                               <b> Forgot password ?</b>
                            </a>
                            </div>
                            </div>
                    </div>
                    <div class="col-1"></div>

                </div>
                            <!--a class="fp" href="#" data-bs-toggle="modal" data-bs-target="#myModal">Forgot password?</a-->                       
                        </div>
                    </div>
                    <div class="col-1"></div>

                <div class="row mt-3 fixed-bottom">
                    <div class="col-3 "></div>
                    <div class="text-center d-grid col-12 p-5" id="col1">
                        <input class="btn btn-outline-dark" type="submit" id="btn" href="#" type="button" name="login" value="LOGIN" style="font-weight: bold">
                    </div>
                    <div class="col-3"></div>
                </div>
                
            </form>

        </div>
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
                    <button type="submit" name="reset" class="btn btn-warning">SUBMIT</button>
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