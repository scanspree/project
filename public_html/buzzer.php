<input type="hidden" id="buz" onclick="buzzer()" type="button" >
 <script>
     function buzzer(){
                var openWindow=window.open('http://192.168.20.229/buzzer/on');
    setTimeout(function(){
        openWindow.close()
        window.location.href='buzzerdemo.php';
    },1000);}
 </script><?php 
include ("connection.php");
 
    $result = $conn->query("SELECT flag FROM pdt_tag  WHERE tag_id = '330AC7A3' ;");
    if ($result == TRUE) {
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['flag'] != 0) {
          echo "<script> document.getElementById('buz').click();
</script>";
        }
           else{
            header("Location: buzzerdemo.php");
          }
      }}
?>