
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Password update</title>
    <script>
        function toggle() {

            var x = document.getElementById("password");
            var y = document.getElementById("repassword");


            if (x.type == "password" && y.type == "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
</head>

<body>
    <?php
    include("connection.php");

    if (isset($_GET['email']) && isset($_GET['reset_token'])) {
        date_default_timezone_set('Asia/kolkata');
        $date = date("y-m-d");
        $sql = "SELECT * FROM  `admin_login` WHERE `email`='$_GET[email]' AND `resettoken`='$_GET[reset_token]' AND `resettokenexpire`='$date'";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            if ($result->num_rows == 1) {
                echo "
            <div class='container p-5 my-5 bg-dark text-black'>
            <h3 style = 'color:white;'><center>Create new password</center></h3>
            <form method='POST' action='' name='updateform'>
                
                <div class='row' id='row1'>
                    <div class='col'>
                        <div class='form-floating mb-3 mt-3'>
                            <input type='password' class='form-control' id='password' name='password' placeholder='password' required>
                            <label for='password'>Password</label>
                            <input type='checkbox' onclick='toggle();'><h7 style = 'color:white;'>Show Password</h7>
                        </div>
                    </div>
                </div>

                <input type='hidden' class='form-control' id='email' name='email' value='$_GET[email]'>

                <div class='row mt-3'>
                    <div class='col-3 '></div>
                    <div class='col-6 text-center ' id='col1'>
                        <a class='btn ' id='btn' href='login.php' name='back' role='button'><b>Cancel</b></a>
                        <input class='btn' type='submit' id='btn' href='#' role='button' name='update'  value='Update'>
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
    $update="UPDATE  `admin_login` SET `password`='$pass', `resettoken`=NULL,`resettokenexpire`=NULL WHERE `email`='$_POST[email]'";
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
</body>

</html>