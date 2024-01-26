<?php
include "connection.php";

$id = $_GET['id'];
$sql = "DELETE FROM appointments WHERE id = $id";
$result = mysqli_query($con, $sql);
if($result){
    header("Location: appointments.php?msg= Appointment Deleted Successfully!");
}
else{
    echo "Failed:" . mysqli_error($con);
}
?>