<?php
include("connection.php");
session_start();

if (isset($_POST['login'])) {
    $sql = "SELECT * FROM `customer_login` WHERE `email`='$_POST[username]' OR `username`='$_POST[username]'";
    $result = $conn->query($sql);
    if ($result == true) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
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
    <link rel="stylesheet" href="style.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

    <nav class="navbar ">
        <div class="container">
            <a class="navbar-brand" id="logo" href="#">
                <img src="cartlogo.png" alt="ScanSpree" width="60" height="60" class="d-inline-block align-text-top">
                <b>ScanSpree</b>
            </a>
        </div>
    </nav>

    <div class="vh-100 container-fluid">
        <h2>
            <div class="row justify-content-center mt-3">Login Form</div>
        </h2>
        <div class="container">

            <form method="POST" action="" name="logform">
                <div class="row" id="row1">
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Email/Username" required>
                            <label for="username">Email/Username</label>
                        </div>
                    </div>
                </div>

                <div class="row" id="row2">
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                            <label for="password">Password</label>
                            <input type="checkbox" onclick="toggle();">Show Password
                        </div>
                    </div>
                </div>


                <!-- Button to Open the Modal -->
                <a class="fp" href="#" data-bs-toggle="modal" data-bs-target="#myModal">
                    Forgot password ?
                </a>

                <div class="row mt-3">
                    <div class="col-3 "></div>
                    <div class="col-6 text-center " id="col1">
                        <a class="btn " id="btn" href="homepg.php" name="back" role="button"><b>Cancel</b></a>
                        <input class="btn" type="submit" id="btn" href="#" role="button" name="login" value="Login">
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
                    <button type="submit" name="reset" class="btn btn-primary">Send Link</button>
                </div>
                </form>
            </div>
        </div>
    </div>




    <script>
        function toggle() {

            var x = document.getElementById("password");

            if (x.type == "password") {
                x.type = "text";

            } else {
                x.type = "password";
            }
        }
    </script>

</body>

</html>