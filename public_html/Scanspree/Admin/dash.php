<?php
include("connection.php");
session_start();

/*ADDING PRODUCT*/

if (isset($_POST['add'])) {
    file_put_contents('admindata.php',"");

  $sql1 = "SELECT * FROM `pdt_invt` WHERE  `product_id` = '$_POST[product_id]' OR `product_name`= '$_POST[productname]' ";
  $result1 = $conn->query($sql1);
  if ($result1 == TRUE) {
    if ($result1->num_rows > 0) {
      $row1 = $result1->fetch_assoc();
      if ($row1['product_id'] == $_POST['product_id'] || $row1['product_name'] == $_POST['productname']) {
        echo "
        <script>
        alert('Product already Added');
        </script>
        ";
      }
    } else {
      $pid = $_POST['product_id'];
      $pname = $_POST['productname'];
      $price = $_POST['price'];

      $sql2 = "INSERT INTO `pdt_invt`(`product_id`, `product_name`, `product_price`,`quantity`) VALUES ('$pid','$pname','$price',0)";

      $result2 = $conn->query($sql2); //fire query

      if ($result2 == TRUE) {
         echo"
        <script>
        alert('Product Details Added Successfully');
        </script>";

          $tagids= $_POST['tagid'];
          foreach($tagids as $t){
            $sql1 = "SELECT * FROM `pdt_tag` WHERE  `tag_id` = '$t'";
           $result1 = $conn->query($sql1);
            if ($result1 == TRUE) {
          if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            if ($row1['tag_id'] == $t) {
              echo "
              <script>
              alert('Tag Id already exists');
              </script>
              ";
            }
          } else {
            $pid = $_POST['product_id'];
      
            $sql2 = "INSERT INTO `pdt_tag`(`tag_id`, `product_id`, `flag`) VALUES ('$t','$pid',0)";
      
            $result2 = $conn->query($sql2); //fire query
      
            if ($result2 == TRUE) {
              
            } else {
              echo "error: " . $sql2 . "<br>" . $conn->error;
            }
          }
        } else {
          echo "<script>
          alert('Cannot run query');
          </script>";
        }
       

          } echo "
          <script>
          alert('Tags Added Successfully');
          </script>";


      } else {
        echo "error: " . $sql2 . "<br>" . $conn->error;
      }
    }
  } else {
    echo "<script>
    alert('Cannot run query');
    </script>";
  }
}

/*ADDING TAGS*/ 
if (isset($_POST['addtag'])) {
    file_put_contents('admindata.php',"");
  $pdid = $_POST['prod_id'];
  $pdname = $_POST['prodname'];
  $pdprice = $_POST['prod_price'];

  $sql12 = "UPDATE `pdt_invt` SET `product_name`= '$pdname',`product_price`=$pdprice WHERE `product_id`= $pdid";

  $result12 = $conn->query($sql12); //fire query

  if ($result12 == TRUE) {
     echo"
    <script>
    alert('Product Details Added Successfully');
    </script>";

      $tagid= $_POST['tgid'];
      foreach($tagid as $t){
        $sql1 = "SELECT * FROM `pdt_tag` WHERE  `tag_id` = '$t'";
       $result1 = $conn->query($sql1);
        if ($result1 == TRUE) {
      if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        if ($row1['tag_id'] == $t) {
          echo "
          <script>
          alert('Tag Id already exists');
          </script>
          ";
        }
      } else {
        $pdid = $_POST['prod_id'];
  
        $sql2 = "INSERT INTO `pdt_tag`(`tag_id`, `product_id`, `flag`) VALUES ('$t','$pdid',0)";
  
        $result2 = $conn->query($sql2); //fire query
  
        if ($result2 == TRUE) {
          
        } else {
          echo "error: " . $sql2 . "<br>" . $conn->error;
        }
      }
    } else {
      echo "<script>
      alert('Cannot run query');
      </script>";
    }
   

      } echo "
      <script>
      alert('Tags Added Successfully');
      window.location.href='dash.php';
      </script>";


  }
}


/*ADDING CART*/ 

if (isset($_POST['addcart'])) {
  $sql1 = "SELECT * FROM `cart` WHERE  `cart_id` = '$_POST[cart_id]' OR `esp_id`= '$_POST[espid]' ";
  $result1 = $conn->query($sql1);
  if ($result1 == TRUE) {
    if ($result1->num_rows > 0) {
      $row1 = $result1->fetch_assoc();
      if ($row1['cart_id'] == $_POST['cart_id'] || $row1['esp_id'] == $_POST['espid']) {
        echo "
        <script>
        alert('Cart already Added');
        </script>
        ";
      }
    } else {
      $cid = $_POST['cart_id'];
      $espid = $_POST['espid'];
      
      $sql2 = "INSERT INTO `cart`(`cart_id`, `esp_id`) VALUES ('$cid','$espid')";

      $result2 = $conn->query($sql2); //fire query

      if ($result2 == TRUE) {
        echo "
        <script>
        alert('Cart Details Added Successfully');
        </script>";
      } else {
        echo "error: " . $sql2 . "<br>" . $conn->error;
      }
    }
  } else {
    echo "<script>
    alert('Cannot run query');
    </script>";
  }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<link rel="stylesheet" href="css/bootstrap.css">-->
  <style>
    <?php include "style3.css" ?>
  </style>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style3.css">
  <script src="js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Harmattan&display=swap');
  </style>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script><?php include "jquery.min.js" ?></script>
    <script src="jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
      $(document).ready(function(){
    $.ajax({
        url:"admindata.php",
        dataType: "json",
        success: function(data){
            $.each(data, function(key,value){
                $("#addform").append("<div class='form-floating mb-3 mt-3 col-8'><input type='text' class='form-control' id='tagid' name='tagid[]' value="+value+" /><label for='tgid'>Tag ID</label></div>");
            });
        }
    });
    setInterval(function() {
        $.ajax({
            url:"admindata.php",
            dataType: "json",
            success: function(data){
                // Loop through each input field in the form
                $("#addform input[name='tagid[]']").each(function() {
                    var inputVal = $(this).val(); // Get the value of the input field
                    var found = false;
                    // Loop through each value in the returned data
                    $.each(data, function(key, value) {
                        if (value == inputVal) { // Check if the value exists in the returned data
                            found = true;
                            return false; // Exit the loop
                        }
                    });
                    if (!found) { // If the value is not found, remove the input field from the form
                        $(this).parent().remove();
                    }
                });
                // Loop through each value in the returned data
                $.each(data, function(key,value){
                    // Check if the input field with the value already exists in the form
                    if ($("#addform input[name='tagid[]'][value='"+value+"']").length == 0) {
                        // If it does not exist, append a new input field to the form
                        $("#addform").append("<div class='form-floating mb-3 mt-3 col-8'><input type='text' class='form-control' id='tagid' name='tagid[]' value="+value+" /><label for='tgid'>Tag ID</label></div>");
                    }
                });
            }
        });
    }, 500);
});
</script>
<script>
      $(document).ready(function(){
    $.ajax({
        url:"admindata.php",
        dataType: "json",
        success: function(data){
            $.each(data, function(key,value){
                $("#editform").append("<div class='form-floating mb-3 mt-3 col-8'><input type='text' class='form-control' id='tgid' name='tgid[]' value="+value+" /><label for='tgid'>Tag ID</label></div>");
            });
        }
    });
    setInterval(function() {
        $.ajax({
            url:"admindata.php",
            dataType: "json",
            success: function(data){
                // Loop through each input field in the form
                $("#editform input[name='tgid[]']").each(function() {
                    var inputVal = $(this).val(); // Get the value of the input field
                    var found = false;
                    // Loop through each value in the returned data
                    $.each(data, function(key, value) {
                        if (value == inputVal) { // Check if the value exists in the returned data
                            found = true;
                            return false; // Exit the loop
                        }
                    });
                    if (!found) { // If the value is not found, remove the input field from the form
                        $(this).parent().remove();
                    }
                });
                // Loop through each value in the returned data
                $.each(data, function(key,value){
                    // Check if the input field with the value already exists in the form
                    if ($("#editform input[name='tgid[]'][value='"+value+"']").length == 0) {
                        // If it does not exist, append a new input field to the form
                        $("#editform").append("<div class='form-floating mb-3 mt-3 col-8'><input type='text' class='form-control' id='tgid' name='tgid[]' value="+value+" /><label for='tgid'>Tag ID</label></div>");
                    }
                });
            }
        });
    }, 500);
});

 </script>
 
 
 
 
 <script>
    function cd() {
      
      document.getElementById("orderdtls").style.display = "none";
      document.getElementById("adpd").style.display = "none";
      document.getElementById("tgpd").style.display = "none";
      document.getElementById("pdlt").style.display = "none";
      document.getElementById("adct").style.display = "none";
      document.getElementById("options").style.display = "none";
      document.getElementById("ctlt").style.display = "none";
      document.getElementById("chart").style.display = "none";
      document.getElementById("custdtls").style.display = "block";
    }

    function ol() {
      document.getElementById("custdtls").style.display = "none";
      document.getElementById("adpd").style.display = "none";
      document.getElementById("tgpd").style.display = "none";
      document.getElementById("pdlt").style.display = "none";
      document.getElementById("adct").style.display = "none";
      document.getElementById("options").style.display = "none";
      document.getElementById("ctlt").style.display = "none";
      document.getElementById("chart").style.display = "none";
      document.getElementById("orderdtls").style.display = "block";
    }

    function ad() {
      document.getElementById("custdtls").style.display = "none";
      document.getElementById("orderdtls").style.display = "none";
      document.getElementById("tgpd").style.display = "none";
      document.getElementById("pdlt").style.display = "none";
      document.getElementById("adct").style.display = "none";
      document.getElementById("options").style.display = "none";
      document.getElementById("ctlt").style.display = "none";
      document.getElementById("chart").style.display = "none";
      document.getElementById("adpd").style.display = "block";
    }

    function tg() {
      document.getElementById("custdtls").style.display = "none";
      document.getElementById("orderdtls").style.display = "none";
      document.getElementById("adpd").style.display = "none";
      document.getElementById("pdlt").style.display = "none";
      document.getElementById("adct").style.display = "none";
      document.getElementById("options").style.display = "none";
      document.getElementById("ctlt").style.display = "none";
      document.getElementById("chart").style.display = "none";
      document.getElementById("tgpd").style.display = "block";
    }

    function pl() {
      document.getElementById("custdtls").style.display = "none";
      document.getElementById("orderdtls").style.display = "none";
      document.getElementById("adpd").style.display = "none";
      document.getElementById("tgpd").style.display = "none";
      document.getElementById("adct").style.display = "none";
      document.getElementById("options").style.display = "none";
      document.getElementById("ctlt").style.display = "none";
      document.getElementById("chart").style.display = "none";
      document.getElementById("pdlt").style.display = "block";

    }
    function st() {
      document.getElementById("custdtls").style.display = "none";
      document.getElementById("orderdtls").style.display = "none";
      document.getElementById("adpd").style.display = "none";
      document.getElementById("tgpd").style.display = "none";
      document.getElementById("adct").style.display = "none";
      document.getElementById("options").style.display = "none";
      document.getElementById("ctlt").style.display = "none";
      document.getElementById("pdlt").style.display = "none";
      document.getElementById("chart").style.display = "block";
    }
    function plb() {
      window.location.href="dash.php";
    }
    function ct() {
     document.getElementById("custdtls").style.display = "none";
      document.getElementById("orderdtls").style.display = "none";
      document.getElementById("adpd").style.display = "none";
      document.getElementById("tgpd").style.display = "none";
      document.getElementById("pdlt").style.display = "none";
      document.getElementById("options").style.display = "none";
      document.getElementById("adct").style.display = "none";
      document.getElementById("chart").style.display = "none";
      document.getElementById("ctlt").style.display = "block";
    }

    function ctd() {
     document.getElementById("custdtls").style.display = "none";
      document.getElementById("orderdtls").style.display = "none";
      document.getElementById("adpd").style.display = "none";
      document.getElementById("tgpd").style.display = "none";
      document.getElementById("pdlt").style.display = "none";
      document.getElementById("options").style.display = "none";
      document.getElementById("ctlt").style.display = "none";
      document.getElementById("chart").style.display = "none";
      document.getElementById("adct").style.display = "block";
    }

    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    $(document).ready(function() {
      $("#myInpu").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTabl tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
   
  </script>
  <script>
      function adprod(){
            var a = document.addprod.product_id.value;
            if (a.length > 4 || a == "" || isNaN(a)) {
            alert("product_id : Enter only 4 character");
            return false;
            }
            
            var p = document.addprod.price.value;
            if ( p == "" || isNaN(p)) {
            alert("price : Enter only number");
            return false;
            }
      }
      function edprod(){
            var a = document.editprod.prod_id.value;
            if (a.length > 4 || a == "" || isNaN(a)) {
            alert("product_id : Enter only 4 character");
            return false;
            }
            
            var p = document.editprod.prod_price.value;
            if ( p == "" || isNaN(p)) {
            alert("price : Enter only number");
            return false;
            }
      }
  </script>
 <title>Dashboard</title>
</head>
<body>
<div class="grid-container">

    <!-- Header -->
    <header class="header">
      <div class="header-right">
      <span class="material-symbols-rounded">account_circle</span>
        <a href='logout.php' role='button'>
        <span class="material-symbols-rounded">logout</span>
  </div>

    </header>
    <!-- End Header -->

    <!-- Sidebar -->
    <aside id="sidebar">
      <div class="sidebar-title">
        <div class="sidebar-brand">
        <img src="Images/ss.png" alt="ScanSpree" width="180" height="80" class="d-inline-block align-text-top">
        </div>
      </div>

      <ul class="sidebar-list">
        <li class="sidebar-list-item">

          <a href="dash.php" target="">
          <span class="material-symbols-rounded">grid_view</span> Dashboard
          </a>
        </li>
        <li class="sidebar-list-item">
        <a class="btn " id="btn" role="button" onclick="pl();" name="pd">
        <span class="material-symbols-rounded">inventory_2</span> Products
          </a>
        </li>
        <li class="sidebar-list-item">
        <a class="btn " id="btn" role="button" onclick="cd();">
        <span class="material-symbols-rounded">group</span> Customers
          </a>
        </li>
        <li class="sidebar-list-item">
        <a class="btn " id="btn" role="button" onclick="ct();">
        <span class="material-symbols-rounded">add_shopping_cart</span> Carts
          </a>
        </li>
        <li class="sidebar-list-item">
        <a class="btn " id="btn" role="button" onclick="ol();">
        <span class="material-symbols-rounded">order_approve</span> Order List
          </a>
        </li>
        <li class="sidebar-list-item">
        <a class="btn " id="btn" role="button" onclick="st();">
          <span class="material-symbols-rounded">monitoring</span> Statistics
          </a>
        </li>
      </ul>
    </aside>
    <!-- End Sidebar -->

    <!-- Main -->
  <main class="main-container" >
      <div class="main-cards" id="options">
        <div class="card">
          <div class="card-inner">
            <p><b>Inventory</b></p>
            <span class="material-symbols-rounded">trolley</span>
          </div>
          <?php
        $sql8 = "SELECT * FROM `pdt_tag`";
        if($result8 = $conn->query($sql8)){
          $invtCount = mysqli_num_rows($result8);
        }
        ?>
          <span><?php echo $invtCount; ?></span>
         </div>

        <div class="card">
          <div class="card-inner">
            <p><b>Orders</b></p>
            <span class="material-symbols-rounded">receipt_long</span>
          </div>
          <?php
        $sql9 = "SELECT * FROM `order_list`";
        if($result9 = $conn->query($sql9)){
          $orderCount = mysqli_num_rows($result9);
        }
        ?>
          <span><?php echo $orderCount; ?></span>
        </div>

        <div class="card">
          <div class="card-inner">
            <p><b>Customers</b></p>
            <span class="material-symbols-rounded">group_add</span>
          </div>
          <?php
        $sql10 = "SELECT * FROM `customer_login`";
        if($result10 = $conn->query($sql10)){
          $customerCount = mysqli_num_rows($result10);
        }
        ?>
          <span><?php echo $customerCount; ?></span>
        </div>

      </div>

     
   
    <!-- End Main -->

    
  <div class="container-fluid" id="1">
    <br>

    <div class="row justify-content-center">
      <div class="col-md-6 " id="custdtls">
        <br>
        <h4 id="hd"><strong>CUSTOMER DETAILS</strong></h4><br>
        <input class="form-control" id="myInput" type="text" placeholder="Search.."><br>
        <?php
        $sql3 = "SELECT * FROM `customer_login`";
        $result3 = $conn->query($sql3);
        ?>

        <table class="table table-bordered">
          <thead class="table-dark">
            <tr>
              <th>Customer ID</th>
              <th>Username</th>
              <th>Email</th>
              <th>Contact</th>
            </tr>
          </thead>
          <tbody id="myTable">
            <?php

            if ($result3->num_rows > 0) {

              while ($row3 = $result3->fetch_assoc()) {

            ?>
                <tr>
                  <td><?php echo $row3['customer_id']; ?></td>
                  <td><?php echo $row3['username']; ?></td>
                  <td><?php echo $row3['email']; ?></td>
                  <td><?php echo $row3['contact']; ?></td>

                </tr>

            <?php
              }
            }
            ?>
          </tbody>

        </table>
      </div>
    </div>



    <div class="row justify-content-center">
      <div class="col-md-6 " id="orderdtls">
        <br>
        <h4 id="hd"><strong>ORDERS LIST</strong></h4><br>
        <input class="form-control" id="myInpu" type="text" placeholder="Search.."><br>
        <?php
        $sql4 = "SELECT * FROM `order_list`";
        $result4 = $conn->query($sql4);
        ?>

        <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
              <th>Order ID</th>
              <th>Customer ID</th>
              <th>Cart ID </th>
              <th>Date</th>
              <th>Total Amount</th>
            </tr>
          </thead>
          <tbody id="myTabl">
            <?php

            if ($result4->num_rows > 0) {

              while ($row4 = $result4->fetch_assoc()) {

            ?>
                <tr>
                  <td><?php echo $row4['order_id']; ?></td>
                  <td><?php echo $row4['customer_id']; ?></td>
                  <td><?php echo $row4['cart_id']; ?></td>
                  <td><?php echo $row4['order_date']; ?></td>
                  <td><?php echo $row4['total_amount']; ?></td>
                </tr>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  

    <div class="row justify-content-center">
      <div class="col-md-6" id="adpd">
        <br>
        <h4 id="hd">Add Product</h4><br>
        <form method="POST" action="dash.php" name="addprod" onsubmit="return adprod();" id="addform">
             <div class="row mt-3">
            <div class="col-6 text-end ">
            <a class="btn btn-warning" id="btn" role="button" onclick="pl();">Back</a>
              <input class="btn btn-warning" type="submit" id="btn" role="button" name="add" value="Add">
            </div>
          </div>
          <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" id="product_id" name="product_id" placeholder="product_id" required>
            <label for="product_id">Product ID</label>
          </div>
          <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" id="productname" name="productname" placeholder="productname" required>
            <label for="productname">Product Name</label>
          </div>
          <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" id="price" name="price" placeholder="price" required>
            <label for="price">Price</label>
          </div>
         

         
        </form>
        <br>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6 " id="tgpd">
        <?php 
        if(isset($_GET['pid'])){
          echo "<script>
          function tg() {
            document.getElementById('custdtls').style.display = 'none';
            document.getElementById('orderdtls').style.display = 'none';
            document.getElementById('adpd').style.display = 'none';
            document.getElementById('pdlt').style.display = 'none';
            document.getElementById('adct').style.display = 'none';
            document.getElementById('options').style.display = 'none';
            document.getElementById('ctlt').style.display = 'none';
            document.getElementById('chart').style.display = 'none';
            document.getElementById('tgpd').style.display = 'block';
          }
          window.onload=event=>{
            tg();
          };
          </script>";
          $pid=$_GET['pid'];
          $sql="SELECT * FROM `pdt_invt` WHERE `product_id`='$pid'";
          $result = $conn->query($sql);
    
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $prod_id=$row['product_id'];
              $prod_name=$row['product_name'];
              $prod_price=$row['product_price'];
        ?>
<br>
        <h4 id="hd">Add Tags</h4><br>
      <form method="POST" action="dash.php" name="editprod" onsubmit="return edprod();" id="editform">
           <div class="row mt-3">
            <div class="col-6 text-end ">
            <a class="btn btn-warning" id="btn" role="button" onclick="plb();">Back</a>
              <input class="btn btn-warning" type="submit" id="btn" role="button" name="addtag" value="Save">
            </div>
          </div>
          <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" id="product_id" name="prod_id" value="<?php echo $prod_id ;?>" placeholder="product_id" required>
            <label for="product_id">Product ID</label>
          </div>
          <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" id="productname" name="prodname" value="<?php echo $prod_name ;?>" placeholder="productname" required>
            <label for="productname">Product Name</label>
          </div>
          <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" id="price" name="prod_price"  value="<?php echo $prod_price ;?>"placeholder="price" required>
            <label for="price">Price</label>
          </div>
        
          

         
        </form>
        <?php
          
        }
      }
    }
      ?>
        <br>
      </div>
    </div>
 
    
    <div class="row justify-content-center">
      <div class="col-md-6 " id="pdlt">
        <br>
        <div class="button-container">
        <h4 id="hd"><strong>PRODUCT LIST</strong></h4>
        <a class="btn btn-warning" id="btn_addp" role="button" onclick="ad();"> + Add product</a></div>   
        <br>
          <script>
             $(document).ready(function() {
      $("#myInputs").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTables tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
          </script>
        <input class="form-control" id="myInputs" type="text" placeholder="Search..">
        <br>
        <?php
        $sql5 = "SELECT * FROM `pdt_invt`";
        $result5 = $conn->query($sql5);
        ?>
        <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
              <th>Product ID</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="myTables">
            <?php

            if ($result5->num_rows > 0) {

              while ($row5 = $result5->fetch_assoc()) {

            ?>
                <tr>
                  <td><?php echo $row5['product_id']; ?></td>
                  <td><?php echo $row5['product_name']; ?></td>
                  <td><?php echo $row5['product_price']; ?></td>
                  <td><?php echo $row5['quantity']; ?></td>
                  <td><a class="btn btn-dark" href="dash.php?pid=<?php echo $row5['product_id'];?>">Edit</a></td>
                </tr>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>



    <div class="row justify-content-center">
      <div class="col-md-6 " id="ctlt">
        <br>
        <div class="button-container">
        <h4 id="hd"><strong>CART LIST</strong></h4>
        <a class="btn btn-warning" id="btn_addc" role="button" onclick="ctd();"> + Add Cart</a></div>   
        <br>
          
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
        <?php
        $sql7 = "SELECT * FROM `cart`";
        $result7 = $conn->query($sql7);
        ?>
        <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
              <th>CART ID</th>
              <th>ESP ID</th>
            </tr>
          </thead>
          <tbody id="myTable">
            <?php

            if ($result7->num_rows > 0) {

              while ($row7 = $result7->fetch_assoc()) {

            ?>
                <tr>
                  <td><?php echo $row7['cart_id']; ?></td>
                  <td><?php echo $row7['esp_id']; ?></td>
                </tr>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6 " id="chart">
        <br>
        <h4 id="hd"><strong>STATISTICS</strong></h4><br>
      <?php $query = "SELECT `month`, `sales` FROM `sales`";

// Execute query
$result = $conn->query($query);

// Fetch data
$labels = array();
$values = array();
//$data = array();
while ($row = mysqli_fetch_assoc($result)) {
   // $data[] = $row;
    $labels[] = $row['month'];
    $values[] = $row['sales'];
}
?>
<canvas id="myChart"></canvas>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'SALES REPORT',
            data: <?php echo json_encode($values,JSON_NUMERIC_CHECK); ?>,
            backgroundColor: [
                '#F87116'

            ],
            borderColor: 'black',

            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
    x: {
      display: true,
      title: {
        display: true,
        text: 'Month'
      }
    },
    y: {
      display: true,
      title: {
        display: true,
        text: 'Sales'
      }
    }
  }
    }
});
</script>

          </div>
          </div>



    <div class="row justify-content-center">
      <div class="col-md-6 " id="adct">
        <br>
        <h4 id="hd">Add Cart</h4>
        <form method="post">
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" id="cart_id" name="cart_id" placeholder="cart_id" required>
          <label for="product_id">Cart id</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" id="espid" name="espid" placeholder="espid" required>
          <label for="tagid">ESP id</label>
        </div>

        <div class="row mt-3">
          <div class="col-6 text-end ">
            <input class="btn" type="submit" id="btn" role="button" name="addcart" value="Add">
          </div>
        </div>
        </form>
        <br>
      </div>
    </div>

    <br>

    <div class="row">
      <div class="col-3 "></div>
      <div class="col-6 text-center " id="col1">

      </div>
      <div class="col-3"></div>
    </div>

    </main>
    </div>
</body>
</html>