<?php
session_start();
require_once 'settings.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Enhancements</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php include 'header.inc'; ?>
<?php include 'menu.php'; ?>

<div class="enhancements-container">
    <h1>PHP Enhancements</h1>
    <p>This enhancement allows a manager to dynamically sort EOI records by selected fields.</p>

    <section class="enhancement">
        <h2>Sort EOI Records</h2>
        <form method="GET" action="phpenhancement.php">
            <label for="sort_field">Sort By:</label>
            <select name="sort_field" id="sort_field">
                <option value="EOINumber">EOI Number</option>
                <option value="job_reference">Job Reference</option>
                <option value="first_name">First Name</option>
                <option value="last_name">Last Name</option>
                <option value="email">Email</option>
                <option value="status">Status</option>
            </select>
            <input type="submit" value="Sort">
        </form>

        <?php
        // Establish connection
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) {
            die("<p>Database connection failed: " . mysqli_connect_error() . "</p>");
        }

        // Default sorting
        $sort_field = "EOINumber";
        $allowed_fields = ["EOINumber", "job_reference", "first_name", "last_name", "email", "status"];

        if (isset($_GET['sort_field']) && in_array($_GET['sort_field'], $allowed_fields)) {
            $sort_field = $_GET['sort_field'];
        }

        // Build query
        $query = "SELECT EOINumber, job_reference, first_name, last_name, email, phone, status FROM eoi ORDER BY $sort_field ASC";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "<p>Error retrieving records: " . mysqli_error($conn) . "</p>";
        } elseif (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>";
            echo "<tr>
                    <th>EOI Number</th>
                    <th>Job Reference</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                  </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['EOINumber']) . "</td>
                        <td>" . htmlspecialchars($row['job_reference']) . "</td>
                        <td>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['phone']) . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No records found.</p>";
        }

        mysqli_close($conn);
        ?>
    </section>
</div>

<?php include 'footer.inc'; ?>

</body>
</html>
