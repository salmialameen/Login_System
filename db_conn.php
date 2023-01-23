<?php

$hostname = "localhost";
$dbUser   = "root";
$dbPassword = "";
$dbName = "ibnmasud";

 
$conn =  mysqli_connect($hostname, $dbUser, $dbPassword, $dbName);
if(! $conn){
   die("<div class='w3-container w3-animate-zoom w3-red w3-round-large w3-padding'>Connection not successful</div> <br>");

}

// $sname = "localhost";
// $uname = "root";
// $password = "";

// $db_name = "ibnmasud";

// $conn = mysqli_connect($sname, $uname, $password, $db_name);

// if(!$conn){
//     echo ("<div class='w3-container w3-animate-zoom w3-red w3-round-large w3-padding'>Connection Failed</div> <br>");

// }

