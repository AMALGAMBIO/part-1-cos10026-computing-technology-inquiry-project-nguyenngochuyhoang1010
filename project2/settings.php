<?php
$host = "feenix-mariadb.swin.edu.au";
$user = "s105514373"; 
$password = "230901";
$database = "s105514373_db"; 

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable detailed MySQL errors

try {
    $conn = new mysqli($host, $user, $password, $database);
    echo "Connected successfully!"; // Debugging
} catch (mysqli_sql_exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>