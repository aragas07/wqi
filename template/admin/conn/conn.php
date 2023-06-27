<?php

// main connection file for both admin & front end
$servername = "localhost"; //server
$username = "root"; //username
$password = ""; //password
$dbname = "pujada_monitoring";  //database
$conn = mysqli_connect($servername, $username, $password, $dbname);


// $servername = "localhost"; //server
// $username = "id20965188_pujadam"; //username
// $password = "PujadaMonitoring_07"; //password
// $dbname = "id20965188_pujadamonitoring";  //database
// $conn = mysqli_connect($servername, $username, $password, $dbname);

class DBConnection{
    public function conn(){
        return new mysqli("localhost","root","","pujada_monitoring");
    }
}
// Create connection
// connecting
// Check connection
if (!$conn) {       //checking connection to DB
    die("Connection failed: " . mysqli_connect_error());
}

?>