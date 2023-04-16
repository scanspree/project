<?php 
include "connection.php";
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
    <script src="https://kit.fontawesome.com/5852560405.js" crossorigin="anonymous"></script>
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
                $("#myForm").append("<div class='form-floating mb-3 mt-3 col-8'><input type='text' class='form-control' id='tagid' name='tagid[]' value="+value+" /></div>");
            });
        }
    });
    setInterval(function() {
        $.ajax({
            url:"admindata.php",
            dataType: "json",
            success: function(data){
                // Loop through each input field in the form
                $("#myForm input[name='tagid[]']").each(function() {
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
                    if ($("#myForm input[name='tagid[]'][value='"+value+"']").length == 0) {
                        // If it does not exist, append a new input field to the form
                        $("#myForm").append("<div class='form-floating mb-3 mt-3 col-8'><input type='text' class='form-control' id='tagid' name='tagid[]' value="+value+" /></div>");
                    }
                });
            }
        });
    }, 500);
});


</script>
</head>

<body>

                <form id="myForm" method="POST" action="pay.php">
                    <input type="text" value="utem">
                     <input class="btn btn-warning" type="submit" id="btn" role="button" name="pay">
                </form>

    </div>

</body>
</html>