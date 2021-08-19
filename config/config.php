<?php
ob_start(); //Turns on output buffering
session_start();
//Timezone
$time_zone = date_default_timezone_set('Africa/Kampala');

$con = mysqli_connect("localhost", "root", "", "socialmedia");
if(mysqli_connect_errno()){
    echo "Failed to connect:" . mysqli_connect_errno();
}    