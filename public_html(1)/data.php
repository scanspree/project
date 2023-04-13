<?php 
    include("connection.php");
//$ser_data=array();
 //   $d=;
 $UIDresultdata=array();
 $user="Ashley";
  $esp="ESP30";
$d=file_get_contents("dum.txt");
$sda=explode("\n",$d);;
foreach($sda as $s){
    $usd=unserialize($s);

     if (in_array($usd, $UIDresultdata)) {

  $Key = array_search($usd, $UIDresultdata);

  array_splice($UIDresultdata,$Key, 1);
}
else{
$UIDresultdata[]=$usd;

}
}
foreach($UIDresultdata as $u){
 $result = $conn->query("SELECT c.cart_id , u.username,t.tag_id, p.product_id,p.product_name, p.product_price FROM cart c,customer_login u,pdt_invt p JOIN pdt_tag t ON p.product_id = t.product_id WHERE t.tag_id = '$u'  AND t.flag = 0 AND u.username='$user' AND c.esp_id='$esp';");
 while($row=$result->fetch_assoc()){
      $read[]=$row;
 }}

echo json_encode($read); ?>