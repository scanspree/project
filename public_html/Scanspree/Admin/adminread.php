<?php

$UIDres=array();

$UIDres=$_POST["UIDresult"];


$sd=serialize($UIDres)."\n";


file_put_contents('admindum.txt',$sd,FILE_APPEND);
   
 $sql = "SELECT * FROM pdt_tag  WHERE tag_id = '$"."u';";
	  $sql='"'.$sql.'"';
	   $sda="explode('"."'\'"."n".",$"."d)";
    
    
     $Write='<?php 
    include("connection.php");

 $'.'UIDresultdata=array();
$'.'d=file_get_contents("admindum.txt");
$'.'sda=explode("\n",$d);

foreach($'.'sda as $'.'s){

    $'.'usd=unserialize($'.'s);
     if (in_array($'.'usd, $'.'UIDresultdata)) {
  $'.'Key = array_search($'.'usd, $'.'UIDresultdata);
  array_splice($'.'UIDresultdata,$'.'Key, 1);
}
else{
$'.'UIDresultdata[]=$'.'usd;
}
}

foreach($'.'UIDresultdata as $'.'u){
 $'.'result = $'.'conn->query('.$sql.');
if ($'.'result == TRUE) {
      if ($result->num_rows > 0) {
      } else {
       
  $'.'read[]=$'.'u;
}}}
array_pop($read);
echo json_encode($'.'read); ?>';


$status = file_put_contents('admindata.php',$Write);

	if($status)
    echo 'Data written successfully.';
	else
    echo 'Something went wrong!';

?>


