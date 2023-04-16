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
        <?php include "display.css" ?>
    </style>
    <script src="https://kit.fontawesome.com/5852560405.js" crossorigin="anonymous"></script>
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
          $("#my_table").html("<tr><th>Items</th><th></th><th>Price</th><th> </th></tr>");
          $.each(data, function(key,value){
          var productId = value.product_id;
  if (productId in products) {
    products[productId].quantity += 1;
    products[productId].price += parseInt(value.product_price);
    var row = $('#my_table tr[data-product-id="' + productId + '"]');
    row.find('.quantity').text(products[productId].quantity);
    row.find('.price').text(products[productId].price.toFixed(0));
  //  $('#my_table').on('click', '.minus-image', function(){
  //  $('#myModal').modal('show');
 // });
  $('#myModal').on('click', '#ok-btn', function(){
    $('#myModal').modal('hide');
});
  } else {
   
    products[productId] = {
      quantity: 1,
      price: parseInt(value.product_price)
    }; 
     $("#my_table").append("<tr data-product-id=" + productId + "><td>" + value.product_name +"</td><td class='quantity'>1</td><td class='price' id='pri'>"+value.product_price +"</td><td><a href='#' data-toggle='modal' data-target='#myModal'><img src='Images/minus.png' class='minus-image'></a></td></tr>");
  }                    
});
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
                  $("#my_table").html("<tr><th>Items</th><th></th><th>Price</th><th></th><th> </th></tr>");
                  $("#empty").html("");
                    if(data){
                   
                    var uid = [];
                        var esp;
                      var products = {};
                  
                   
                    $.each(data, function(key,value){
                        if (value.username == <?php echo json_encode($_SESSION["username"]) ?>) {

uid.push(value.tag_id);
esp = value.cart_id;  
                      var productId = value.product_id;
  
  if (productId in products) {
  
    products[productId].quantity += 1;
    products[productId].price += parseInt(value.product_price);
    var row = $('#my_table tr[data-product-id="' + productId + '"]');
    row.find('.quantity').text("("+products[productId].quantity+")");
    row.find('.price').text(products[productId].price.toFixed(0));
   // $('#my_table').on('click', '.minus-image', function(){
   // $('#myModal').modal('show');
 // });
  $('#myModal').on('click', '#ok-btn', function(){
$("#myModal").modal("hide");
});
  } else {
   
    products[productId] = {
      quantity: 1,
      price: parseInt(value.product_price)
    }; 
     $("#my_table").append("<tr data-product-id=" + productId + "><td class='product-name'>" + value.product_name +"</td><td class='quantity'>(1)</td><td class='price' id='pri'>"+value.product_price +"</td><td><a href='#' data-bs-toggle='modal' data-bs-target='#myModal'><img src='Images/minus.png' class='minus-image'></a></td></tr>");
  }          
}   
                    });
                     var total = 0;
$('.price').each(function() {
    total += parseInt($(this).text());
});
      $('#total-price').text(total);
       //   $('amount').text(total);
         $('#totalamount').val($('#total-price').text());
                     $('#uid').text(uid);
                        $('#tagid').val($('#uid').text());
                        $('#esp').text(esp);
                        $('#cart_id').val($('#esp').text());
               }else{
                  $("#empty").append("<tr id='emp'><td id='emp'><div class='empty-container' scroll='no' id='empty-block'><ul class='empty-list'><span class='material-symbols-rounded'>upcoming</span> <li>Your cart is empty</li><p>Looks like you've not added any items yet!</p></ul></div><td></tr>");
                  var total = 0;
                        $('#total-price').text(total);
       //   $('amount').text(total);
         $('#totalamount').val($('#total-price').text());
                     $('#uid').text(uid);
                        $('#tagid').val($('#uid').text());
                        $('#esp').text(esp);
                        $('#cart_id').val($('#esp').text());}
               }
                   
            });
  }, 500);
        })

</script>

</head>

<body>
<!-- The Modal -->
<div class="modal p-3" id="myModal" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        To remove an item re-scan the Product Tag and replace it.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="ok-btn">OK</button>
      </div>
    </div>
  </div>
</div>

    <div class="container-sm">
        <div class="row">
        <div class="col-7"><img src="Images/logo2.svg" id="img2" alt="ScanSpree"></div>
        <div class="col-2"></div>
        <div class=" col-3" style="position: relative;">
      <span class="material-symbols-rounded" id="acc">account_circle</span><br>
      <?php
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
             echo "<p  id='user'><b>$_SESSION[username]<b></p>";

             $sql = "SELECT * FROM `customer_login` WHERE `username`='$_SESSION[username]'";
             $result = $conn->query($sql);

             if ($result->num_rows > 0) {
                 while ($row = $result->fetch_assoc()) {
                     $cust_id = $row['customer_id'];
                     $cust_name = $row['username'];
                     $cust_contact = $row['contact'];
                     $cust_email = $row['email'];
                 }
             }
            }
           ?>
        <!--a href='logout.php' role='button'>
        <span class="material-symbols-rounded">logout</span-->
      </div>
      </div>
    </div>
    <br>
    <div class="container p-1">
    <table class="table table-borderless p-2" id="my_table">
       
        </table> 
          </div>   
            <!--tr>
                <th class="text-center" style="width: 200px;">ID</th>
                <th style="width: 150px;">Items</th>
                <th style="width: 340px;">Price</th>
                <th style="width: 50px;"></th>
            </tr>
       
    </table>

<EMPTY LIST BLOCK-->
<table id="empty">
</table> 
    

    <div class="container-fluid fixed-bottom">
        <br>
        <div class="row">
            <div class="col-1"></div>
              <div class="col-6"><strong><h4 id="total-price"></h4></strong></div>
                <div class="col-3"></div>
        </div>
       
    <!--a href="#" class="circular-button peach-gradient">
        <span class="material-symbols-rounded" id="payicon">currency_rupee</span>
    </a-->

    <p id="uid" hidden></p>
                <p id="esp" hidden></p>
<p id="amount" hidden></p>
                <form id="myForm" method="POST" action="pay.php">
                    <input type="hidden" id="userid" name="userid" value="<?php echo $cust_id; ?>">
                    <input type="hidden" id="username" name="username" value="<?php echo $cust_name; ?>">
                    <input type="hidden" id="contact" name="contact" value="<?php echo $cust_contact; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $cust_email; ?>">
                    <input type="hidden" id="totalamount" name="totalamount">
                    <input type="hidden" id="cart_id" name="cart_id">
                    <input type="hidden" id="tagid" name="tagid">
                    
                       
      
        <b> <input class="btn circular-button peach-gradient" type="submit" id="btn" role="button" name="pay" value="₹"></b>
    
                    <!--input class="btn circular-button peach-gradient" type="submit" id="btn" role="button" name="pay"-->
                </form>

    </div>

</body>
</html>
