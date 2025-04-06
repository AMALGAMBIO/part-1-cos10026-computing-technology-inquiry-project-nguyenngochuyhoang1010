<?php
$host = "feenix-mariadb.swin.edu.au";
$user = "s105514373";
$pwd = "230901"; 
$sql_db = "s105514373_db";

$conn = new mysqli($host, $user, $pwd, $sql_db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $pwd, $sql_db);
    // Removed the echo statement here
} catch (mysqli_sql_exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
