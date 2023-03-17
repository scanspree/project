<?php
	$UserID = $_GET['id']; 
	$UIDresult=$_POST["UIDresult"];
     $Write="<?php $" . "UIDresult='" . $UIDresult . "'; " . "echo $" . "UIDresult;" . " ?>";
	$status = file_put_contents('test.php',$Write);
	if($status)
    echo "Data written successfully.";
else
    echo "Something went wrong!";
?>
