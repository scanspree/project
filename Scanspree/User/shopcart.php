
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
    <title>shopping list</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="shopcart.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Harmattan&display=swap');
  </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        <?php include "shopcart.css" ?>
    </style>
</head>

<body>
    
    <div class="container-sm">
        <div class="row">
        <div class="col-8"><img src="Images\logo2.svg" id="img2" alt="ScanSpree"></div>
        <div class="col-4">
      <span class="material-symbols-rounded">account_circle</span>
      <?php
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
             echo "<h1 id='user'>$_SESSION[username]</h1>";
            }
           ?>
        <!--a href='logout.php' role='button'>
        <span class="material-symbols-rounded">logout</span-->
</div>
           </div>
    </div>
    <br>

    <table class="table table-borderless m-2">
        <thead>
            <tr>
                <th class="text-center" style="width: 200px;">Items</th>
                <th style="width: 150px;"></th>
                <th style="width: 340px;">Price</th>
                <th style="width: 50px;"></th>
            </tr>
        </thead>
    </table>

<!--EMPTY LIST BLOCK-->
    <div class="empty-container" scroll="no" id="empty-block">
       <ul class="empty-list">
       <span class="material-symbols-rounded">upcoming</span>
         <li>Your cart is empty</li>
         <p>Looks like you've not added any items yet!</p>
        </ul>
    </div>

    <div class="container-fluid fixed-bottom">
    <a href="#" class="circular-button peach-gradient">
        <span class="material-symbols-rounded" id="payicon">currency_rupee</span>
    </a>

        <!--div class="row" style="text-align: center">
            <p>Rs. 0</p>
        </div-->

    </div>

</body>
</html>