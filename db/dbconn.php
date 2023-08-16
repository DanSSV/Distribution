<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "trisakaydb";

$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
}


?>