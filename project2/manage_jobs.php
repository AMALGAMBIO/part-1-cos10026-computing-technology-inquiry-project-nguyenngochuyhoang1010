<?php
// Ensure database connection is established
$host = "feenix-mariadb.swin.edu.au";
$user = "s105550173";
$pwd = "Nam105550173";
$sql_db = "s105550173_db";

$dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$dbconn) {
    echo "<p style='color: red; text-align: center;'>Unable to connect to the database.</p>";
    exit();
}

// Add job logic (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_job'])) {
    $title = mysqli_real_escape_string($dbconn, $_POST['title']);
    $description = mysqli_real_escape_string($dbconn, $_POST['description']);
    $main_skills = mysqli_real_escape_string($dbconn, $_POST['main_skills']);
    $other_skills = mysqli_real_escape_string($dbconn, $_POST['other_skills']);

    // Insert new job into the database
    $query = "INSERT INTO jobs (title, description, main_skills, other_skills) 
              VALUES ('$title', '$description', '$main_skills', '$other_skills')";

    if (mysqli_query($dbconn, $query)) {
        header("Location: manage_jobs.php"); // Redirect back after adding job
        exit();
    } else {
        echo "<p style='color: red; text-align: center;'>Error adding job. Please try again.</p>";
    }
}

// Delete selected jobs (POST request)
if (isset($_POST['delete_selected']) && !empty($_POST['job_ids'])) {
    foreach ($_POST['job_ids'] as $job_id) {
        $job_id = mysqli_real_escape_string($dbconn, $job_id);

        // Delete the selected job
        $query = "DELETE FROM jobs WHERE ref_num = '$job_id'";
        if (!mysqli_query($dbconn, $query)) {
            echo "<p style='color: red; text-align: center;'>Error deleting job with ID: $job_id. Please try again.</p>";
        }
    }

    header("Location: manage_jobs.php"); // Redirect after deletion
    exit();
}

// Query jobs for display
$query = "SELECT * FROM jobs";
$result = mysqli_query($dbconn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Jobs</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/stylemenu.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container {
            margin-bottom: 30px;
        }
        .form-container input, .form-container textarea {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #218838;
        }
        .job-listings {
            margin-top: 30px;
        }
        .job-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .job-card .job-info {
            flex-grow: 1; /* Allow the text to take up available space */
        }
        .job-card input[type="checkbox"] {
            margin-left: 10px; /* Space between the text and checkbox */
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #a71d2a;
        }
        .job-info .job-title {
            font-weight: bold; /* Bold the job title */
            font-size: 16px; /* Optional: Adjust the font size for better visibility */
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
    <h1>Manage Jobs</h1>

    <!-- Add Job Form -->
    <div class="form-container">
        <h2>Add a New Job</h2>
        <form action="manage_jobs.php" method="post">
            <input type="text" name="title" placeholder="Job Title" required>
            <textarea name="description" placeholder="Job Description" required></textarea>
            <input type="text" name="main_skills" placeholder="Main Skills" required>
            <input type="text" name="other_skills" placeholder="Other Skills" required>
            <button type="submit" name="add_job">Add Job</button>
        </form>
    </div>

    <!-- Existing Job Listings -->
    <h2>Existing Jobs</h2>
    <form method="post">
        <div class="job-listings">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='job-card'>";
                    echo "<div class='job-info'>";
                    echo "<div class='job-title'>" . htmlspecialchars($row['title']) . "</div>";
                    echo "<div>" . htmlspecialchars($row['description']) . "</div>";
                    echo "</div>";
                    echo "<div><input type='checkbox' name='job_ids[]' value='" . htmlspecialchars($row['ref_num']) . "'></div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No jobs available.</p>";
            }
            ?>
        </div>
        <button type="submit" name="delete_selected" class="delete-btn">Delete Selected Jobs</button>
    </form>
</div>

<?php include_once "footer.inc"; ?>

</body>
</html>

<?php
mysqli_close($dbconn);
?>
