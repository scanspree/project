
<?php

require('config.php');
require('connection.php');
session_start();

require('razorpay/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;
function convertToNumericCode($string) {
  $string = preg_replace("/[^a-zA-Z0-9]/", "", $string);
  $hash = hash('adler32', $string);
  $numericCode = sprintf("%08d", hexdec($hash) % 100000000);
  return $numericCode;
}
$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
   
    $customer_id=$_POST['cust_id'];
    $cart_id=$_POST['cart_id'];
    $amount=$_POST['totalamount'];
   $uid=$_POST['tagid'];
   $current_date = date('Y-m-d');
    $orderid=convertToNumericCode($_SESSION['razorpay_order_id']);
   $tagid=explode(',',$uid);
   
  // $html="";
 foreach($tagid as $t){
    $sql="UPDATE `pdt_tag` SET `flag`= 1 WHERE `tag_id`= '$t'";
    $result = $conn->query($sql); //fire query
     if ($result == TRUE) {
               } else {
          //  echo "error: " . $sql . "<br>" . $conn->error;
            }
      }
      
   $sql1="INSERT INTO `order_list`(`order_id`, `customer_id`, `cart_id`, `order_date`, `total_amount`) VALUES ($orderid,$customer_id,$cart_id,'$current_date',$amount)";
           $result1 = $conn->query($sql1); //fire query
     if ($result1 == TRUE) {
         
          foreach($tagid as $t){
        $sql2="SELECT p.product_id, p.product_price FROM pdt_invt p JOIN pdt_tag t ON p.product_id = t.product_id WHERE t.tag_id = '$t'  AND t.flag = 1 ";
        $result2 = $conn->query($sql2); //fire query
         if ($result2 == TRUE) {
              if ($result2->num_rows == 1) {
              $row2 = $result2->fetch_assoc();
              $p_id=$row2['product_id'];
              $pri=$row2['product_price'];
  $sq="INSERT INTO `ordered_product`(`order_id`, `product_id`, `tag_id`, `order_date`, `price`) VALUES ($orderid,$p_id,'$t','$current_date',$pri)";
   $result3 = $conn->query($sq); //fire query
  if ($result3 == TRUE) {
      
    
  } else {
            //echo "error: " . $sql3 . "<br>" . $conn->error;
            }
              }
             
            
               } else {
            //echo "error: " . $sql2 . "<br>" . $conn->error;
            }
      }
      
     } else {
           // echo "error: " . $sql1 . "<br>" . $conn->error;
            }
  
   


    $true = "  <div class='container' >

            <div class='icon'>
                <span class='material-symbols-rounded' id='staricon1'>auto_awesome</span>
            </div>
            <div class='icon'>
                <span class='material-symbols-rounded' id='paymentdone'>credit_score</span>
            </div>
            <div class='icon'>
                <span class='material-symbols-rounded' id='staricon2'>auto_awesome</span>
            </div>
        </div>
<div class='row mt-3 fixed-bottom'>
            <div class='col-3 '></div>

            <div class='text-center d-grid col-12 p-5' id='col'>
                <h4>Payment Successful!</h4>
                <input class='btn btn-outline-dark' type='submit' id='btn' onclick='resetESP()' type='button' name='ok'
                    value='OK' style='font-weight: bold'>
            </div>
            <div class='col-3'></div>


        </div>
            
              ";
}
else
{
   // $html = "<p>Your payment failed</p>
   //         <p>{$error}</p>";
}
 ?>
 <!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200' />

    <link rel='stylesheet' href='css/bootstrap.min.css'>

    <link href='https://fonts.googleapis.com/css2?family=Material+Icons+Sharp' rel='stylesheet'>
    <script src='js/bootstrap.js'></script>
    <script>
    function resetESP(){
       var openWindow=window.open('http://192.168.20.229/reset');
    setTimeout(function(){
        openWindow.close()
        window.location.href='scanpg.php';
    },1000);
    }
    </script>
    <title>Payment Verify</title>
 
    <style>
        <?php include 'payment.css' ?>
    </style>
    
</head>

<body>
    <div class='container-fluid' id='pay' scroll='no'>
        <div class='top'>
            <img src='Images\paywave.jpg' alt='ScanSpree' width='100%' height='180px' class='d-inline-block align-text-top' !important>
        </div>


      

       


<?php echo $true;?>
       
    </div>






</body>

</html>



