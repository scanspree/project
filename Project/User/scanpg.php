<?php
include("connection.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<link rel="stylesheet" href="css/bootstrap.css">-->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style1.css">
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
        <?php include "style1.css" ?>
    </style>
  <title>Main page</title>
</head>

<body class="container-fluid">
  <nav class="navbar vh-15">
    <div class="container">
      <a class="navbar-brand" id="logo" href="#">
        <img src="images/cartlogo.png" alt="ScanSpree" width="60" height="60" class="d-inline-block align-text-top">
        <b>ScanSpree</b>
      </a>
      <a id="user">
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
          echo "<h4 id='h'>$_SESSION[username]</h4> <a class='btn btn-primary' href='logout.php' role='button'>LOGOUT</a>";
        }

        ?>
      </a>
    </div>
  </nav>

  <div class="vh-75 container-fluid" id="1">
    <br><br><br>
    <div class="row justify-content-center">

      <div class="col-md-6 text-center" id="col1">
        <br><br>
        <h3>Welcome to ScanSpree</h3>
        <?php
        echo "<h3><strong>$_SESSION[username]</strong></h3>";
        ?><br><br>
        <p>Enjoy a new shopping experience with ScanSpree!</p>

      </div>

    </div>

    <br>
    <div class="row">
      <div class="col-3 "></div>
      <div class="col-6 text-center " id="col1">
        <a class="btn " id="btn" onclick="function qr();" role="button"><b>Scan QR To Begin</b></a>
      </div>
      <div class="col-3"></div>
    </div>


  </div>

</body>

</html>