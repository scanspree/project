<?php
include("connection.php");
session_start();

if (isset($_POST['add'])) {
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

      $sql2 = "INSERT INTO `pdt_invt`(`product_id`, `product_name`, `product_price`) VALUES ('$pid','$pname','$price')";

      $result2 = $conn->query($sql2); //fire query

      if ($result2 == TRUE) {
        echo "
        <script>
        alert('Product Details Added Successfully');
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
    <?php include "style1.css" ?>
  </style>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style1.css">
  <script src="js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script>
    function cd() {
      document.getElementById("options").style.visibility = "hidden";
      document.getElementById("custdtls").style.display = "block";
    }

    function ol() {
      document.getElementById("options").style.visibility = "hidden";
      document.getElementById("orderdtls").style.display = "block";
    }

    function ad() {
      document.getElementById("options").style.visibility = "hidden";
      document.getElementById("adpd").style.display = "block";
    }

    function tg() {
      document.getElementById("options").style.visibility = "hidden";
      document.getElementById("tgpd").style.display = "block";
    }

    function pl() {
      document.getElementById("options").style.visibility = "hidden";
      document.getElementById("pdlt").style.display = "block";

    }
    function ct() {
      document.getElementById("options").style.visibility = "hidden";
      document.getElementById("adct").style.display = "block";
    }

    function bk() {
      document.getElementById("custdtls").style.display = "none";
      document.getElementById("orderdtls").style.display = "none";
      document.getElementById("adpd").style.display = "none";
      document.getElementById("tgpd").style.display = "none";
      document.getElementById("pdlt").style.display = "none";
      document.getElementById("adct").style.display = "none";
      document.getElementById("options").style.visibility = "visible";
    }

    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>


  <title>Main page</title>
</head>

<body class="container-fluid">
  <nav class="navbar vh-15">
    <div class="container">
      <a class="navbar-brand" id="logo" href="#">
        <img src="images/ss.png" alt="ScanSpree" width="300" height="120" class="d-inline-block align-text-top">
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
    <br>

    <div class="row justify-content-center">
      <div class="col-md-6 " id="custdtls" .>
        <br>
        <h4 id="hd">Customer Details</h4>
        <button type="button" class="btn-close" id="hd" onclick="bk();"></button>
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <?php
        $sql3 = "SELECT * FROM `customer_login`";
        $result3 = $conn->query($sql3);
        ?>

        <table class="table table-bordered">
          <thead>
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
        <h4 id="hd">Order List</h4>
        <button type="button" class="btn-close" id="hd" onclick="bk();"></button>
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <?php
        $sql4 = "SELECT * FROM `order_list`";
        $result4 = $conn->query($sql4);
        ?>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer_ID</th>
              <th>Time</th>
              <th>Total Amount</th>
            </tr>
          </thead>
          <tbody id="myTable">
            <?php

            if ($result4->num_rows > 0) {

              while ($row4 = $result4->fetch_assoc()) {

            ?>
                <tr>
                  <td><?php echo $row4['order_id']; ?></td>
                  <td><?php echo $row4['cust_id']; ?></td>
                  <td><?php echo $row4['time']; ?></td>
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
      <div class="col-md-6 " id="adpd">
        <br>
        <h4 id="hd">Add Product</h4>
        <button type="button" class="btn-close" id="hd" onclick="bk();"></button>
        <form method="POST">
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

          <div class="row mt-3">
            <div class="col-6 text-end ">
              <input class="btn" type="submit" id="btn" role="button" name="add" value="Add">
            </div>
          </div>
        </form>
        <br>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6 " id="tgpd">
        <br>
        <h4 id="hd">Product Tagging</h4>
        <button type="button" class="btn-close" id="hd" onclick="bk();"></button>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" id="product_id" name="product_id" placeholder="product_id" required>
          <label for="product_id">Product ID</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" id="tagid" name="tagid" placeholder="tagid" required>
          <label for="tagid">Tag ID</label>
        </div>

        <div class="row mt-3">
          <div class="col-6 text-end ">
            <input class="btn" type="submit" id="btn" role="button" name="tag" value="Tag">
          </div>
        </div><br>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6 " id="pdlt">
        <br>
        <h4 id="hd">PRODUCT List</h4>
        <button type="button" class="btn-close" id="hd" onclick="bk();"></button>
        <input class="form-control" id="myInput" type="text" placeholder="Search..">

        <?php
        $sql5 = "SELECT * FROM `pdt_invt`";
        $result5 = $conn->query($sql5);
        ?>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Product ID</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody id="myTable">
            <?php

            if ($result5->num_rows > 0) {

              while ($row5 = $result5->fetch_assoc()) {

            ?>
                <tr>
                  <td><?php echo $row5['product_id']; ?></td>
                  <td><?php echo $row5['product_name']; ?></td>
                  <td><?php echo $row5['product_price']; ?></td>
                  <td><?php echo $row5['quantity']; ?></td>
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
      <div class="col-md-6 " id="adct">
        <br>
        <h4 id="hd">Add Cart</h4>
        <button type="button" class="btn-close" id="hd" onclick="bk();"></button>
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



    <div class="d-grid gap-2 col-6 mx-auto" id="options">
      <a class="btn " id="btn" role="button" onclick="ad();"><b>Add product</b></a>
      <a class="btn " id="btn" role="button" onclick="tg();"><b>Tag product</b></a>
      <a class="btn " id="btn" role="button" onclick="cd();"><b>Customer details</b></a>
      <a class="btn " id="btn" role="button" onclick="pl();" name="pd"><b>Product List</b></a>
      <a class="btn " id="btn" role="button" onclick="ol();"><b>Order list</b></a>
      <a class="btn " id="btn" role="button" onclick="ct();"><b>Add cart</b></a>

    </div>
    <br>
  </div>

</body>

</html>