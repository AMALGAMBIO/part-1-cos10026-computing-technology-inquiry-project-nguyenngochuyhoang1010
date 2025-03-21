<?php
require_once "settings.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eoi_number'], $_POST['status'])) {
    $eoiNumber = intval($_POST['eoi_number']);
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "UPDATE eoi SET Status = '$status' WHERE EOInumber = $eoiNumber";
    $conn->query($sql);
}

header("Location: manage.php");
exit();
?>