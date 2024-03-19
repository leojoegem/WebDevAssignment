<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Phonestore";
$port = 3308;  // Change this to the correct port number

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
