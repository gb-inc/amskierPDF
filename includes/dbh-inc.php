<?php
$host = "localhost";
$db = "dbo_claimswc";
$username = "root";
$password = "";
$conn = mysqli_connect($host, $username, $password, $db);

if(!$conn){
    die("There was a problem connecting to the database!" . mysqli_connect_error());
}