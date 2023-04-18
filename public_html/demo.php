<?php

$UIDres=array();

$UIDres=$_POST["UIDresult"];
$userid=$_POST["id"];
$esp=$_POST["esp"];

$sd=serialize($UIDres)."\n";


file_put_contents('dum.txt',$sd,FILE_APPEND);

 $sq = "SELECT flag FROM pdt_tag  WHERE tag_id = '$UIDres' ;";
   $sq='"'.$sq.'"';
 
    $flag="flag";
      $flag="'".$flag."'";
      $buz="buz";
      $buz="'".$buz."'";
$href="buzzerdemo.php";
      $href="'".$href."'";
            $link="http://192.168.20.229/buzzer/on";
      $link="'".$link."'";
$wr='<input type="hidden" id="buz" onclick="buzzer()" type="button" >
 <script>
     function buzzer(){
                var openWindow=window.open('.$link.');
    setTimeout(function(){
        openWindow.close()
        window.location.href='.$href.';
    },1000);}
 </script><?php 
include ("connection.php");
 
    $'.'result = $'.'conn->query('.$sq.');
    if ($result == TRUE) {
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['.$flag.'] != 0) {
          echo "<script> document.getElementById('.$buz.').click();
</script>";
        }
           else{
            header("Location: buzzerdemo.php");
          }
      }}
?>';
 $sat = file_put_contents('buzzer.php',$wr);


	if($sat){
	  
	}
    else
    echo 'Something went wrong!';
 
	    


    
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



