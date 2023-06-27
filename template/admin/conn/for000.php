<?php

//main connection file for both admin & front end
$servername = "localhost"; //server
$username = "id20381103_root"; //username
$password = "-@12um$5Scz%ezf4"; //password
$dbname = "id20381103_monitoring_db";  //database

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$conn) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());
}

?>