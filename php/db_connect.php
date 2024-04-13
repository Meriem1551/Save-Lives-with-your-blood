<?php  
$servername = "localhost:3308";
$username="root";
$password="";
$dbname="hope_lab";

$id = new mysqli($servername, $username, $password, $dbname);
if (!$id) { die("Connection failed: " . $id->connect_error); }  
?>