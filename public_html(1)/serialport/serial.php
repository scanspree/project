<?php

require_once('php_serial.class.php');

$serial = new phpSerial();

$serial->deviceSet('COM4');
$serial->confBaudRate(9600);

$serial->deviceOpen();

$data = $serial->readPort();

$serial->deviceClose();

// Do something with $data here

?>
