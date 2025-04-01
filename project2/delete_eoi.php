<?php
require_once "settings.php";

if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['job_ref'])) {
        $jobRef = $_POST['job_ref'];

        $stmt = $conn->prepare("DELETE FROM eoi WHERE job_reference = ?");
        $stmt->bind_param("s", $jobRef);

        if ($stmt->execute()) {
            echo "<script>alert('All EOIs for Job Reference: $jobRef have been deleted.'); window.location.href='manage.php';</script>";
        } else {
            echo "<script>alert('Error deleting EOIs: " . $stmt->error . "'); window.location.href='manage.php';</script>";
        }

        $stmt->close();
    }
    elseif (!empty($_POST['eoi_number'])) {
        $eoiNumber = $_POST['eoi_number'];

        $stmt = $conn->prepare("DELETE FROM eoi WHERE EOInumber = ?");
        $stmt->bind_param("i", $eoiNumber);

        if ($stmt->execute()) {
            echo "<script>alert('EOI $eoiNumber deleted successfully.'); window.location.href='manage.php';</script>";
        } else {
            echo "<script>alert('Error deleting EOI: " . $stmt->error . "'); window.location.href='manage.php';</script>";
        }

        $stmt->close();
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href='manage.php';</script>";
}

$conn->close();
?>
