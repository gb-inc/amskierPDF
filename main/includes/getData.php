<?php

$conn = mysqli_connect('localhost', 'root', '', 'amskier');

if(!$conn){
    die('Connection failed!');
}


    $sql = "SELECT * FROM dbo_claimswc WHERE ClaimsWCID = 3420;";
    $result = mysqli_query($conn, $sql);
$data = [];
while($row = mysqli_fetch_assoc($result)){
    array_push($data, $row);
};



exit(json_encode($data));