<?php
include "db_connect.php";

$email = $_POST['user'];
$password = $_POST['pass'];

echo "" . $email . " " . $password;

$sql = "SELECT * FROM users WHERE emailUser = '$email' AND passwordUser = '$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);

if ($count == 1) {
    echo "<h1>Welcome</h1>";
}else{
    echo "<h1>Invalid email or password</h1>";
}


?>