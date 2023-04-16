<?php 
 
while (!file_exists('buzzer.php')) {
    // Wait for 1 second before checking again
    sleep(1);
}
include('buzzer.php');
unlink('buzzer.php');
?>