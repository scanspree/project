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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>
    <?php include "style1.css" ?>
  </style>

  <script>
    function qr() {
      document.getElementById("Scanner").style.display = "none";
     

      document.getElementById("qr").style.display = "none";
   
      document.getElementById("cont").style.display = "block";
    }
   
  </script>
  <title>Main page</title>
</head>

<body class="container-fluid">

  <div class="out mt-3" id="c">
    <a href='logout.php' role='button' id='logout'>
    <span class="material-symbols-rounded" >logout</span></a>
  </div>
  
  <br><br><br><br>
    <div class="row" id="t1">
      <div class="col-3"></div>
        <div class="col-6" >
            <div id="qr" class="img"></div>
        </div>
        <div class="col-3"></div>
    </div>
    

  
  <div class="row justify-content-center" id="Scanner">
        <div class="col-3"></div>
  <div class="text-center d-grid gap-2 col-10">
  <!--a class="btn btn-outline-dark " id="btnscan" onclick="" role="button"><b>Video tutorial</b></a-->
   <?php
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
             echo "<h4 id='user'>$_SESSION[username]</h4>";
            }
           ?>
  <a class="btn btn-outline-dark" id="btnscan" onclick="qr();" role="button"><b>Scan QR</b></a>
  </div>
  <div class="col-3"></div>
 
  </div>
  <div class="row fixed-bottom" id="bottom">
            
            <div class="col"><img src="Images/wave1.svg" width="100%" height="100%" ></div>
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
    <div class="col-md-6"id="cont">
    Scan QR Code
    <br>
     <a id="btn-scan-qr">
        <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg" onclick="scan();">
          </a>
        <canvas hidden="" id="qr-canvas" style="height:280px; width:280px;"></canvas>
        <div id="qr-result" hidden="">
          <b>Data:</b> <p id="outputData"></p>
        </div>
        <script src="src/scanner.js"></script>
    </div>
    <div class="col-3"></div>
  </div>

</body>

</html>