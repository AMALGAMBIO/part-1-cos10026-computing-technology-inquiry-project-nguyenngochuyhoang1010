<?php
require_once 'settings.php'; 

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: apply.html");
    exit();
}

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    die("<p>Database connection failed: " . mysqli_connect_error() . "</p>");
}
    // Collect form data
    $job_reference = isset($_POST["job_reference"]) ? mysqli_real_escape_string($conn, trim($_POST["job_reference"])) : "";
    $first_name = isset($_POST["first_name"]) ? mysqli_real_escape_string($conn, trim($_POST["first_name"])) : "";
    $last_name = isset($_POST["last_name"]) ? mysqli_real_escape_string($conn, trim($_POST["last_name"])) : "";
    $street_address = isset($_POST["street_address"]) ? mysqli_real_escape_string($conn, trim($_POST["street_address"])) : "";
    $suburb_town = isset($_POST["suburb_town"]) ? mysqli_real_escape_string($conn, trim($_POST["suburb_town"])) : "";
    $state = isset($_POST["state"]) ? mysqli_real_escape_string($conn, trim($_POST["state"])) : "";
    $postcode = isset($_POST["postcode"]) ? mysqli_real_escape_string($conn, trim($_POST["postcode"])) : "";
    $email = isset($_POST["email"]) ? mysqli_real_escape_string($conn, trim($_POST["email"])) : "";
    $phone = isset($_POST["phone"]) ? mysqli_real_escape_string($conn, trim($_POST["phone"])) : "";
    $other_skills = isset($_POST["other_skills"]) ? mysqli_real_escape_string($conn, trim($_POST["other_skills"])) : "";

    // Handle checkboxes
    $skillsArray = [];
    if (isset($_POST["Skill1"])) $skillsArray[] = $_POST["Skill1"];
    if (isset($_POST["Skill2"])) $skillsArray[] = $_POST["Skill2"];
    if (isset($_POST["Skill3"])) $skillsArray[] = $_POST["Skill3"];
    $skills = implode(", ", $skillsArray); 

if (!empty($job_reference) && !empty($first_name) && !empty($last_name) && !empty($email)) {
    $query = "INSERT INTO eoi (job_reference, first_name, last_name, street_address, suburb_town, state, postcode, email, phone, skills, other_skills, status) 
              VALUES ('$job_reference', '$first_name', '$last_name', '$street_address', '$suburb_town', '$state', '$postcode', '$email', '$phone', '$skills', '$other_skills', 'New')";

    //Announce Result
    if (mysqli_query($conn, $query)) {
        $eoi_number = mysqli_insert_id($conn);
        echo "<h2>Application Submitted Successfully!</h2>";
        echo "<p>Thank you, <strong>$first_name $last_name</strong>. Your Expression of Interest has been recorded. 🥳🥳🥳</p>";
        echo "<p><strong>Your EOI Number:</strong> $eoi_number</p>";
        exit();
    } else {
        echo "<p>Error submitting Application: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p>Please fill in all required fields.</p>";
}
mysqli_close($conn);
?>
