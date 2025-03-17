<?php
require_once "settings.php";

// Function to sanitize input
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Ensure the request is a POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: apply.php");
    exit();
}

// Retrieve and validate form data
$jobRef = isset($_POST["JobRef"]) ? sanitize($_POST["JobRef"]) : "";
$firstName = isset($_POST["FirstName"]) ? sanitize($_POST["FirstName"]) : "";
$lastName = isset($_POST["LastName"]) ? sanitize($_POST["LastName"]) : "";
$address = isset($_POST["Address"]) ? sanitize($_POST["Address"]) : "";
$suburb = isset($_POST["Suburb"]) ? sanitize($_POST["Suburb"]) : "";
$state = isset($_POST["State"]) ? sanitize($_POST["State"]) : "";
$postcode = isset($_POST["Postcode"]) ? sanitize($_POST["Postcode"]) : "";
$email = isset($_POST["Email"]) ? filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL) : false;
$phone = isset($_POST["Phone"]) ? sanitize($_POST["Phone"]) : "";
$skills = implode(", ", array_filter([$_POST["Skill1"] ?? "", $_POST["Skill2"] ?? "", $_POST["Skill3"] ?? ""]));
$otherSkills = isset($_POST["OtherSkills"]) ? sanitize($_POST["OtherSkills"]) : "";

if (!$email) {
    die("Invalid email address.");
}

// Validate job reference format
if (!preg_match("/^[A-Za-z0-9]{5}$/", $jobRef)) {
    die("Job reference number must be exactly 5 alphanumeric characters.");
}

// Validate names
if (!preg_match("/^[A-Za-z]{1,20}$/", $firstName) || !preg_match("/^[A-Za-z]{1,20}$/", $lastName)) {
    die("First and last names must contain only letters and be max 20 characters.");
}

// Validate phone number
if (!preg_match("/^[0-9 ]{8,12}$/", $phone)) {
    die("Phone number must be 8-12 digits.");
}

// Validate postcode and state match
$postcodeValid = [
    "VIC" => "/^3\d{3}$/",
    "NSW" => "/^2\d{3}$/",
    "QLD" => "/^4\d{3}$/",
    "NT"  => "/^0\d{3}$/",
    "WA"  => "/^6\d{3}$/",
    "SA"  => "/^5\d{3}$/",
    "TAS" => "/^7\d{3}$/",
    "ACT" => "/^0\d{3}$/"
];

if (!preg_match($postcodeValid[$state], $postcode)) {
    die("Postcode does not match state.");
}

// Ensure table exists
$sql_create = "CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    JobReference VARCHAR(5) NOT NULL,
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    Address VARCHAR(40) NOT NULL,
    Suburb VARCHAR(40) NOT NULL,
    State VARCHAR(3) NOT NULL,
    Postcode CHAR(4) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Phone VARCHAR(12) NOT NULL,
    Skills TEXT NOT NULL,
    OtherSkills TEXT,
    Status ENUM('New', 'Current', 'Final') DEFAULT 'New'
)";
$conn->query($sql_create);

// Insert data
$sql_insert = "INSERT INTO eoi (JobReference, FirstName, LastName, Address, Suburb, State, Postcode, Email, Phone, Skills, OtherSkills) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("sssssssssss", $jobRef, $firstName, $lastName, $address, $suburb, $state, $postcode, $email, $phone, $skills, $otherSkills);
$stmt->execute();

$eoiNumber = $stmt->insert_id;
$stmt->close();
$conn->close();

echo "<h1>Application Submitted Successfully</h1>";
echo "<p>Your EOI Number: <strong>$eoiNumber</strong></p>";
echo "<a href='index.php'>Return to Home</a>";
?>