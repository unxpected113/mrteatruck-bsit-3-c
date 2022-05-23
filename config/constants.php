<?php
ob_start();
session_start();
define('SITEURL','https://mrteatrucksystem.000webhostapp.com/');
$servername = "localhost";
$username = "id18953230_mrteatruckdb";
$password = "Mrteatruck1!";
$database = "id18953230_mrteatruckdata";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
