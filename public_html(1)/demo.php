<?php
//	$UserID = $_GET['id'];
$UIDres=array();
//	$UID=$_POST["UIDresult"];
	//if(!in_array($UID,$UIDres)){
//	array_push($UIDres,$_POST["UIDresult"]);
	//$UIDresult[]=$UID;
	
//	$UIDres=file_exists('dum.txt') ? unserialize(file_get_contents('dum.txt')):array();
//array_push($UIDres,$_POST["UIDresult"]);
$UIDres=$_POST["UIDresult"];
$userid=$_POST["id"];
$esp=$_POST["esp"];
//$UIDres['timestamp']=time();
$sd=serialize($UIDres)."\n";
//$sd.="\n";

file_put_contents('dum.txt',$sd,FILE_APPEND);
//$data=serialize($UIDres);
   
foreach($sda as $s){
    $usd=unserialize($s);
    $UIDresultdata[]=$usd;
}

	
	  $sql = "SELECT c.cart_id , u.username,t.tag_id, p.product_id,p.product_name, p.product_price FROM cart c,customer_login u,pdt_invt p JOIN pdt_tag t ON p.product_id = t.product_id WHERE t.tag_id = '$"."u'  AND t.flag = 0 AND u.username='$"."user' AND c.esp_id='$"."esp';";
	  $sql='"'.$sql.'"';
	   $sda="explode('"."'\'"."n".",$"."d)";
    
    
     $Write='<?php 
    include("connection.php");
//$'.'ser_data=array();
 //   $'.'d='.$data.';
 $'.'UIDresultdata=array();
 $'.'user="'.$userid.'";
  $'.'esp="'.$esp.'";
$'.'d=file_get_contents("dum.txt");
$'.'sda=explode("\n",$d);;
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
 while($'.'row=$'.'result->fetch_assoc()){
      $'.'read[]=$'.'row;
 }}

echo json_encode($'.'read); ?>';


$status = file_put_contents('data.php',$Write);

	if($status)
    echo 'Data written successfully.';
	else
    echo 'Something went wrong!';

?>


