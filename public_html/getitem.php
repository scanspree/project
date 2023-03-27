<?php
//	$UserID = $_GET['id']; 
	$UIDresult=$_POST["UIDresult"];
	  echo "$UIDresult";
	  $sql = "SELECT p.product_id,p.product_name, p.product_price FROM pdt_invt p JOIN pdt_tag t ON p.product_id = t.product_id WHERE t.tag_id = '$UIDresult' AND t.flag = 0;";
	  $sql='"'.$sql.'"';
     $Write="<?php $" . "UIDresult[]='" . $UIDresult . "'; " ." foreach ($"."UIDresult as $"."uid) {
	echo $"."uid . '<br>';
}//echo $" . "UIDresult;\n" . " ?>";
	$status = file_put_contents('data.php',$Write,FILE_APPEND);
	if($status)
    echo "Data written successfully.";
  
else
    echo "Something went wrong!";
?>
