<?php
require_once 'settings.php'; // Ensure settings.php is included

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

// Handle checkboxes: Collect selected skills into a single string
$skillsArray = [];
if (isset($_POST["Skill1"])) $skillsArray[] = $_POST["Skill1"];
if (isset($_POST["Skill2"])) $skillsArray[] = $_POST["Skill2"];
if (isset($_POST["Skill3"])) $skillsArray[] = $_POST["Skill3"];
$skills = implode(", ", $skillsArray); // Convert array to string

// Prepare the SQL statement
if (!empty($job_reference) && !empty($first_name) && !empty($last_name) && !empty($email)) {
    $query = "INSERT INTO eoi (job_reference, first_name, last_name, street_address, suburb_town, state, postcode, email, phone, skills, other_skills, status) 
              VALUES ('$job_reference', '$first_name', '$last_name', '$street_address', '$suburb_town', '$state', '$postcode', '$email', '$phone', '$skills', '$other_skills', 'New')";

    // Announce Result
    if (mysqli_query($conn, $query)) {
        $eoi_number = mysqli_insert_id($conn);
        echo "<h2>Application Submitted Successfully!</h2>";
        echo "<p>Thank you, <strong>$first_name $last_name</strong>. Your Expression of Interest has been recorded. 🥳🥳🥳</p>";
        echo "<p><strong>Your EOI Number:</strong> $eoi_number</p>";
        
        // Add the EOI table display
        echo '<style>
            table { border-collapse: collapse; width: 100%; margin-top: 20px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            tr.highlight { background-color: #e6ffe6; }
        </style>';
        
        echo "<h3>Recent Applications</h3>";
        echo "<table>";
        echo "<tr><th>EOI Number</th><th>Job Ref</th><th>Name</th><th>Email</th><th>Status</th></tr>";
        
        // Query to get recent applications
        $table_query = "SELECT * FROM eoi ORDER BY EOInumber DESC LIMIT 10";
        $table_result = mysqli_query($conn, $table_query);
        
        while ($row = mysqli_fetch_assoc($table_result)) {
            $highlight = ($row['EOInumber'] == $eoi_number) ? 'class="highlight"' : '';
            echo "<tr $highlight>";
            echo "<td>{$row['EOInumber']}</td>";
            echo "<td>{$row['job_reference']}</td>";
            echo "<td>{$row['first_name']} {$row['last_name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        echo '<p><a href="apply.php">Return to application form</a></p>';
        exit();
    } else {
        echo "<p>Error submitting Application: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p>Please fill in all required fields.</p>";
}

// Close connection
mysqli_close($conn);
?>
