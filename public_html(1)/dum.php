<?php 


$file_path = $_SERVER['DOCUMENT_ROOT'] ."file:///C:/Users/ashle/OneDrive/Desktop/CoolTermWin64Bit/serial.txt";

$file_contents = file_get_contents($file_path);

echo $file_contents;
?>