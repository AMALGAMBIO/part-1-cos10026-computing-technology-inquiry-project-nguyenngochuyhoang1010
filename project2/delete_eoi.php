<?php
require_once "settings.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eoi_number'])) {
    $eoiNumber = intval($_POST['eoi_number']);

    $sql = "DELETE FROM eoi WHERE EOInumber = $eoiNumber";
    $conn->query($sql);
}

header("Location: manage.php");
exit();
?>