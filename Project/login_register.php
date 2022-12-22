<?php
include("connection.php");
if (isset($_POST['submit'])) {
  $check_query = "SELECT * FROM `customer_login` WHERE `username` = '$_POST[username]' OR `email` = '$_POST[email]'";
  $result2 = $conn->query($check_query);
  echo "1";
  if ($result2 == TRUE) {
    echo "2";
    if ($result2->num_rows > 0) {
      echo "3";
      $row = $result2->fetch_assoc();
        echo "4";
      if($row['username']==$_POST['username']||$row['email']==$_POST['email']){
        echo "5";
        echo "
        <script>
        alert('username or email already exists');
        </script>
        ";
      }
    }else{
      echo "7";
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $name = $fname . " " . $lname;
      $username = $_POST['username'];
      $gender = $_POST['gender'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];
      $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
    
      $v_code = bin2hex(random_bytes(8));
      $sql = "INSERT INTO `customer_login`(`name`, `username`, `gender`, `email`, `contact`, `password`, `ver_code`, `is_verified`) VALUES ('$name','$username','$gender','$email',$contact,'$password','$v_code','0')";
    
      $result = $conn->query($sql); //fire query
    
      if ($result == TRUE) {
        echo "record added";
        header('Location: homepg.php');
      } else {
        echo "error: " . $sql . "<br>" . $conn->error;
      }
    }
      
  } else {
    echo "<script>
    alert('Cannot run query');
    header('Location: reg.php');
    </script>" 
    ;
  }

  
   $conn->close();
  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <script src="js/bootstrap.js"></script>
</head>

<body>

  <nav class="navbar ">
    <div class="container">
      <a class="navbar-brand" id="logo" href="#">
        <img src="cartlogo.png" alt="ScanSpree" width="60" height="60" class="d-inline-block align-text-top">
        <b>ScanSpree</b>
      </a>
    </div>
  </nav>


  <div class="vh-100 container-fluid">
    <h2>
      <div class="row justify-content-center mt-3">Registration Form</div>
    </h2>
    <div class="container">

      <form method="POST" action="reg.php" name="regform" onsubmit="return validate();">
        <div class="row" id="row1">
          <div class="col">
            <div class="form-floating mb-3 mt-3">
              <input type="text" class="form-control" id="firstname" name="fname" placeholder="Firstname" required>
              <label for="firstname">Firstname</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating mb-3 mt-3">
              <input type="text" class="form-control" id="lastname" name="lname" placeholder="lastname" required>
              <label for="lastname">Lastname</label>
            </div>
          </div>
        </div>

        <div class="row" id="row2">
          <div class="col">
            <div class="form-floating mb-3 mt-3">
              <input type="text" class="form-control" id="email" name="email" placeholder="email" required>
              <label for="email">Email</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating mb-3 mt-3">
              <input type="text" class="form-control" id="contact" name="contact" placeholder="Phone Number" required>
              <label for="contact">Phone number</label>
            </div>
          </div>
        </div>

        <div class="row mt-2 " id="row3">
          <div class="col-1">
            <h6 class="mb-2 pb-1">Gender: </h6>
          </div>

          <div class="col">

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" value="male" id="male" required>
              <label class="form-check-label" for="male">
                Male
              </label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" value="female" id="female">
              <label class="form-check-label" for="female">
                Female
              </label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" value="others" id="others">
              <label class="form-check-label" for="others">
                Others
              </label>
            </div>

          </div>
          <div class="col-6">
            <div class="form-floating mb-3 mt-3">
              <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
              <label for="contact">Username</label>
            </div>
          </div>

          <div class="row" id="row4">
            <div class="col">
              <div class="form-floating mb-3 mt-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                <label for="password">Password</label>
                <input type="checkbox" onclick="toggle();">Show Password
              </div>

            </div>
            <div class="col">
              <div class="form-floating mb-3 mt-3">
                <input type="password" class="form-control" id="repassword" name="repassword" placeholder="repassword" required>
                <label for="repassword">Confirm Password</label>
              </div>
            </div>
          </div>


          <div class="row mt-3">
            <div class="col-3 "></div>
            <div class="col-6 text-center " id="col1">
              <a class="btn " id="btn" href="homepg.php" name="back" role="button"><b>Back</b></a>
              <input class="btn" type="submit" id="btn" href="#" role="button" name="submit" value="Submit">
              <!--<input type="submit" name="submit" value="submit">-->
            </div>
            <div class="col-3"></div>
          </div>


      </form>

    </div>
  </div>

  <script>
    function validate() {
      var pass = document.regform.password.value;
      var conpass = document.regform.repassword.value;
      if(pass.length<8)
      {
        alert("Password should be of atleat 8 characters");
        return false;
      }
      
      if (pass != conpass) {
        alert("password is not similar");
        return false;
      }

      

      var a = document.regform.email.value;
      var atpos = a.indexOf("@");
      var dotpos = a.lastIndexOf(".");
      if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= a.length) {
        alert("Enter valid email");
        return false;
      }


      var z = document.regform.contact.value;
      if (z.length != 10 || z == "" || isNaN(z)) {
        alert("Enter valid contact numbers");
        return false;
      }
   
      
    }



    function toggle() {

      var x = document.getElementById("password");
      var y = document.getElementById("repassword");


      if (x.type == "password" && y.type == "password") {
        x.type = "text";
        y.type = "text";
      } else {
        x.type = "password";
        y.type = "password";
      }
    }
  </script>
</body>

</html>