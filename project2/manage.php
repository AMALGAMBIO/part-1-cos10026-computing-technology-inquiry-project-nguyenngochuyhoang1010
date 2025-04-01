<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Managing - The Chill Guys</title>
    <link rel="stylesheet" href="styles/manage.css">
</head>
<?php
require_once "settings.php";
include 'header.inc';
include 'menu.php';

// Establish database connection
$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("<p>Connection failed: " . $conn->connect_error . "</p>");
}

// Initialize filter for SQL query
$filter = "";

if (isset($_GET['job_reference']) && !empty($_GET['job_reference'])) {
    $job_reference = $conn->real_escape_string(trim($_GET['job_reference']));
    $filter = "WHERE job_reference = '$job_reference'";
} elseif (isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $conn->real_escape_string(trim($_GET['name']));
    $filter = "WHERE CONCAT(first_name, ' ', last_name) LIKE '%$name%'";
}

// Fetch EOIs based on filter
$query = "SELECT * FROM eoi $filter ORDER BY EOINumber DESC";
$result = $conn->query($query);

if (!$result) {
    die("<p>Error retrieving records: " . $conn->error . "</p>");
}
?>

<h1>Manage Job Applications</h1>

<form method="GET" action="manage.php">
    <label>Filter by Job Reference:</label>
    <input type="text" name="job_reference">
    <button type="submit">Search</button>
</form>

<form method="GET" action="manage.php">
    <label>Filter by Applicant Name:</label>
    <input type="text" name="name">
    <button type="submit">Search</button>
</form>

<form method="GET" action="manage.php">
    <button type="submit">List All EOIs</button>
</form>

<form method="POST" action="delete_eoi.php">
    <label>Delete EOIs by Job Reference:</label>
    <input type="text" name="job_ref" required>
    <button type="submit" onclick="return confirm('Are you sure you want to delete all EOIs for this job reference?')">Delete</button>
</form>

<?php if ($result->num_rows > 0): ?>
    <table border="1">
        <tr>
            <th>EOI Number</th>
            <th>Job Reference</th>
            <th>Applicant</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Update Status</th>
            <th>Delete</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['EOINumber']) ?></td>
                <td><?= htmlspecialchars($row['job_reference']) ?></td>
                <td><?= htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['phone']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <form method="POST" action="update_status.php">
                        <input type="hidden" name="eoi_number" value="<?= htmlspecialchars($row['EOINumber']) ?>">
                        <select name="status">
                            <option value="New" <?= $row['status'] == "New" ? "selected" : "" ?>>New</option>
                            <option value="Current" <?= $row['status'] == "Current" ? "selected" : "" ?>>Current</option>
                            <option value="Final" <?= $row['status'] == "Final" ? "selected" : "" ?>>Final</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="delete_eoi.php">
                        <input type="hidden" name="eoi_number" value="<?= htmlspecialchars($row['EOINumber']) ?>">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this EOI?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No job applications found.</p>
<?php endif; ?>

<?php
$conn->close();
include 'footer.inc';
?>
