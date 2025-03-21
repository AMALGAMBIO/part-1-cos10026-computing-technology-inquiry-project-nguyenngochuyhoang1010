<?php
require_once 'settings.php'; // Ensure settings.php is included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate a unique EOI number
    $eoiNumber = uniqid("EOI_");

    // Collect form data
    $jobReferenceNumber = $_POST["JobRef"];
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $street = $_POST["Address"]; // Ensure consistency in naming
    $suburb = $_POST["Suburb"];
    $state = $_POST["State"];
    $postcode = $_POST["Postcode"];
    $email = $_POST["Email"];
    $phone = $_POST["Phone"];
    $otherSkills = $_POST["OtherSkills"];
    $applicationDate = date("Y-m-d"); // Capture current date

    // Handle checkboxes: Collect selected skills into a single string
    $skillsArray = [];
    if (isset($_POST["Skill1"])) $skillsArray[] = $_POST["Skill1"];
    if (isset($_POST["Skill2"])) $skillsArray[] = $_POST["Skill2"];
    if (isset($_POST["Skill3"])) $skillsArray[] = $_POST["Skill3"];
    $skills = implode(", ", $skillsArray); // Convert array to string

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO eoi (EOInumber, JobReferenceNumber, FirstName, LastName, Street, Suburb, State, Postcode, Email, Phone, Skills, OtherSkills, ApplicationDate) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssssssssss", $eoiNumber, $jobReferenceNumber, $firstName, $lastName, $street, $suburb, $state, $postcode, $email, $phone, $skills, $otherSkills, $applicationDate);

    // Execute and check result
    if ($stmt->execute()) {
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement & connection
    $stmt->close();
    $conn->close();
}
?>
