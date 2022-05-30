<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "physical_therapy_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}else{
    //echo "Connected successfully";
}
?>