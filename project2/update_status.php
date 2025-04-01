<?php
require_once "settings.php";

if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['eoi_number']) && !empty($_POST['status'])) {
    $eoiNumber = $_POST['eoi_number'];
    $newStatus = $_POST['status'];

    $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
    $stmt->bind_param("si", $newStatus, $eoiNumber);

    if ($stmt->execute()) {
        echo "<script>alert('EOI status updated to: $newStatus'); window.location.href='manage.php';</script>";
    } else {
        echo "<script>alert('Error updating status: " . $stmt->error . "'); window.location.href='manage.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Invalid request'); window.location.href='manage.php';</script>";
}

$conn->close();
?>
