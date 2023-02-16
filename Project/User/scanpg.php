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
  <link rel="stylesheet" href="src/styles.css" />
  <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>


  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style1.css">
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
    <?php include "style1.css" ?>
  </style>



  <script>
    function qr() {
     
      document.getElementById("Scanner").style.display = "none";
    
      document.getElementById("c").style.display = "none";
      document.getElementById("p").style.display = "none";
      document.getElementById("cont").style.display = "block";
    }
   

  </script>
  <title>Main page</title>
</head>

<body class="container-fluid">

  <div class="out" id="c"><a class="btn-close" href='logout.php' role='button'></a></div>
<br><br><br>
  <div class="img" id="p">
    <img src="images/profile.svg" class="rounded-circle" id="profile">
    <br><br>
    <div>
    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
      echo "<h4 id='user'>$_SESSION[username]</h4>";
    }


    ?>
  </div>
</div>

  <br>
  <br>
  <br>

  <br>
  <div class="row" id="Scanner">
        <div class="col-3"></div>
  <div class="text-center d-grid gap-2 col-6">
  <a class="btn btn-outline-dark " id="btnscan" onclick="" role="button"><b>Video tutorial</b></a>
  <a class="btn btn-outline-dark" id="btnscan" onclick="qr();" role="button"><b>Scan QR</b></a>
  </div>
  <div class="col-3"></div>
  </div>
<!--
  <div class="row" id="VidTut">
    <div class="col-3 "></div>
    <div class="col-6 text-center " id="col1">
      <a class="btn btn-outline-dark " id="btnscan" onclick="" role="button"><b>Video tutorial</b></a>
    </div>
    <div class="col-3"></div>
  </div>

  <br>

  <div class="row" id="Scanner">
    <div class="col-3 "></div>
    <div class="col-6 text-center " id="col1">
      <a class="btn btn-outline-dark" id="btnscan" onclick="qr();" role="button"><b>Scan QR</b></a>
    </div>
    <div class="col-3"></div>
  </div>
  -->

  

  <div class="row justify-content-center">
    <div class="col-3"></div>
    <div class="col-md-6 " id="cont">
    Scan QR Code
    <br>
     <a id="btn-scan-qr">
        <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg" onclick="scan();">
        <a />
       
        <canvas hidden="" id="qr-canvas"></canvas>

        <div id="qr-result" hidden="">
          <b>Data:</b> <p id="outputData"></p>
        </div>
        <script src="src/scan.js"></script>
    </div>
    <div class="col-3"></div>
  </div>






</body>

</html>