<?php
include("connection.php");
session_start();
//if(isset($_POST['UIDresult'])){
//$UIDresult=$_POST['UIDresult'];}
 //$data = array();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script><?php include "jquery.min.js" ?></script>
    <script src="jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
	       $(document).ready(function(){
            $.ajax({
                url:"data.php",
                dataType: "json",
                success: function(data){
                      
                      var products = {};
                     $("#my_table").html("<tr><th>Items</th><th>Qnt</th><th>Price</th> </tr>");
                   
                    $.each(data, function(key,value){
                       
                      var productId = value.product_id;
  
  if (productId in products) {
  
    products[productId].quantity += 1;
    products[productId].price += parseInt(value.product_price);
    var row = $('#my_table tr[data-product-id="' + productId + '"]');
    row.find('.quantity').text(products[productId].quantity);
    row.find('.price').text(products[productId].price.toFixed(0));
  } else {
   
    products[productId] = {
      quantity: 1,
      price: parseInt(value.product_price)
    }; 
     $("#my_table").append("<tr data-product-id=" + productId + "><td >" + value.product_name +"</td><td class='quantity'>1</td><td class='price' id='pri'>"+value.product_price +"</td></tr>");
  }                    
           
                    }
);
  var total = 0;
$('.price').each(function() {
    total += parseInt($(this).text());
});
$('#total-price').text(total);
                   
                }
            });
            setInterval(function() {
                $.ajax({
                url:"data.php",
                dataType: "json",
                success: function(data){
                    
                      var products = {};
                    $("#my_table").html("<tr><th>Items</th><th>Qnt</th><th>Price</th></tr>");
                   
                    $.each(data, function(key,value){
                         
                      var productId = value.product_id;
  
  if (productId in products) {
  
    products[productId].quantity += 1;
    products[productId].price += parseInt(value.product_price);
    var row = $('#my_table tr[data-product-id="' + productId + '"]');
    row.find('.quantity').text(products[productId].quantity);
    row.find('.price').text(products[productId].price.toFixed(0));
  } else {
   
    products[productId] = {
      quantity: 1,
      price: parseInt(value.product_price)
    }; 
     $("#my_table").append("<tr data-product-id=" + productId + "><td>" + value.product_name +"</td><td class='quantity'>1</td><td class='price' id='pri'>"+value.product_price +"</td></tr>");
  }             
                    });
                     var total = 0;
$('.price').each(function() {
    total += parseInt($(this).text());
});
$('#total-price').text(total);
                }
            });
		}, 500);
        })

	</script>
	
</head>

<body>
    
    <div class="container-sm">
        <div class="row">
        <div class="col-8"><img src="Images/logo2.svg" id="img2" alt="ScanSpree"></div>
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

    <table class="table table-borderless m-2" id="my_table">
       
        </table>    
            <!--tr>
                <th class="text-center" style="width: 200px;">ID</th>
                <th style="width: 150px;">Items</th>
                <th style="width: 340px;">Price</th>
                <!--th style="width: 50px;"></th>
            </tr>
       
    </table>

<!--EMPTY LIST BLOCK-->
    <!--div class="empty-container" scroll="no" id="empty-block">
       <ul class="empty-list">
       <span class="material-symbols-rounded">upcoming</span>
         <li>Your cart is empty
         <h2 id="getUID"></h2>
           
         <p>Looks like you've not added any items yet!</p>
        </ul>
    </div-->
    

    <div class="container-fluid fixed-bottom">
        <br>
        <div class="row">
            <div class="col-3"></div>
              <div class="col-6"><strong><h4 id="total-price"></h4></strong></div>
                <div class="col-3"></div>
        </div>
       
    <a href="#" class="circular-button peach-gradient">
        <span class="material-symbols-rounded" id="payicon">currency_rupee</span>
    </a>


    </div>

</body>
</html>