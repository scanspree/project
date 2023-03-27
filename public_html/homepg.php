<?php

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
    <style>
        <?php include "style1.css" ?>
    </style>
</head>

<body>
    
    <nav class="navbar fixed-top">
        <div class="container col-sm-1 justify-content-center">
            <a class="navbar-brand" id="logo" href="#">
                <img src="Images\ss.png" id="im" alt="ScanSpree" width="60px" height="40px" class="d-inline-block align-text-top">
            </a>
        </div>
        
</nav>
    
    <div class="container-fluid fixed-bottom" >
        <br>
        <div class="row p-4">
            <div class="col-md-12 col-sm-12 col-12 ">
                <h3><strong>Welcome!</strong></h1> 
            </div>
        <p> Have a great shopping experience using our new self checkout system!</p>
        </div>
        <div class="row p-4 fixed-bottom">
        <div class="col-6"></div>
            <div class="text-center d-grid gap-2 col-12 ">
                <a class="btn btn-outline-dark"  href="login.php" type="button"><b>LOGIN</b></a>
                <a class="btn btn-outline-dark" href="reg.php" type="button"><b>SIGNUP</b></a>
                
            </div>
        <div class="col-3"></div>
        </div>


    </div>
    
</body>

</html>