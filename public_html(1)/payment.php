<!DOCTYPE html>
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
    <title>Document</title>
    <style>
        <?php include "payment.css" ?>
    </style>
</head>

<body>
    <div class="container-fluid" id="pay" scroll="no">
        <div class="top">
            <img src="Images\paywave.jpg" alt="ScanSpree" width="100%" height="180px" class="d-inline-block align-text-top" !important>
        </div>


      

        <div class="container" >

            <div class="icon">
                <span class="material-symbols-rounded" id="staricon1">auto_awesome</span>
            </div>
            <div class="icon">
                <span class="material-symbols-rounded" id="paymentdone">credit_score</span>
            </div>
            <div class="icon">
                <span class="material-symbols-rounded" id="staricon2">auto_awesome</span>
            </div>
        </div>




        <div class="row mt-3 fixed-bottom">
            <div class="col-3 "></div>

            <div class="text-center d-grid col-12 p-5" id="col">
                <h4>Payment Successful!</h4>
                <input class="btn btn-outline-dark" type="submit" id="btn" href="scanpg.php" type="button" name="ok"
                    value="OK" style="font-weight: bold">
            </div>
            <div class="col-3"></div>


        </div>
    </div>






</body>

</html>