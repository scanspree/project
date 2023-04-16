<script>
function reset(){
       var openWindow=window.open('http://192.168.20.229/reset');
    setTimeout(function(){
        openWindow.close()
        window.location.href='scanpg.php';
    },1000);
    }
    reset();</script> 
    
    
    