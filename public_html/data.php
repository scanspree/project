<?php 
    include("connection.php");
//$ser_data=array();
 //   $d=;
 $UIDresultdata=array();
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
 $result = $conn->query("SELECT p.product_id,p.product_name, p.product_price FROM pdt_invt p JOIN pdt_tag t ON p.product_id = t.product_id WHERE t.tag_id = '$u' AND t.flag = 0;");
 while($row=$result->fetch_assoc()){
      $read[]=$row;
 }}

echo json_encode($read); ?>