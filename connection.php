<?php
$servername ="localhost";
$username ="root";
$password = "";
$dname = "website";

$con = mysqli_connect($servername, $username, $password, $dname);

if($con){
    echo "connected";
}