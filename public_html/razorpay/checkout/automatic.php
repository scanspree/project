<!--  The entire list of Checkout fields is available at
 https://docs.razorpay.com/docs/checkout-form#checkout-fields -->
<style>

.razorpay-payment-button{
    border:none;
    color:white;
    font-size:1px;
    background-color: white;
}
</style>

<!--DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
    <title>Payment</title>
    <style>
        
    </style>
</head>

<body>
    <div class="container-fluid" id="pay" scroll="no">
        <div class="top">
            <img src="paywave.jpg" alt="ScanSpree" width="100%" height="180px" class="d-inline-block align-text-top" !important>
        </div>


      



        <div class="row mt-3 fixed-bottom">
           


        </div>
    </div>




</body>

</html-->
<!--script>
    setInterval(function(){
       document.getElementsByClassName("razorpay-payment-button").click();
    },500);
</script-->

<form action="pay_verify.php" method="POST">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data['prefill']['name']?>"
    data-prefill.email="<?php echo $data['prefill']['email']?>"
    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
    data-tagid="<?php echo $data['tagid']?>"
    data-order_id="<?php echo $data['order_id']?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input type="hidden" name="tagid" value="<?php echo $data['tagid']?>">
  <input type="hidden" name="cust_id" value="<?php echo $data['prefill']['id']?>">
  <input type="hidden" name="cart_id" value="<?php echo $data['cartid']?>">
  <input type="hidden" name="totalamount" value="<?php echo $data['totamount']?>">
</form>
<script>
    setInterval(function(){
       var button = document.querySelector('.razorpay-payment-button');
// Trigger a click event on the button
button.click();
    },2000);
</script>
