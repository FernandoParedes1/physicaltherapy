<?php
include "db_connect.php";
$id = $_GET['id'];

$sql = "SELECT * FROM `appointment` WHERE `idAppointment` = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$sql = "DELETE FROM `appointment` WHERE `idAppointment` = $id";
$result = mysqli_query($conn, $sql);
if($result){
    header("Location: dashboard.php?id=".$row['idDoctor']);
}else{
    header("Location: dashboard.php?id=".$row['idDoctor']);
}
?>