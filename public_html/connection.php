<?php

$servername="localhost";
$username="u938498053_root";
$password="#2023Scanspree";
$dbname="u938498053_scart_db";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
    die("Connection failed: ".$conn->connect_error);
} 

?>