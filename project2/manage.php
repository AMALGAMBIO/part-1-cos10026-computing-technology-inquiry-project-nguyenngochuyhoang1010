<?php
require_once "settings.php";

// Basic session authentication (replace with your actual auth logic)
session_start();
if (!isset($_SESSION['manager_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Display success message if redirected from update_status.php
if (isset($_GET['update_success'])) {
    $success_message = "Status updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Job Applications</title>
    <link rel="stylesheet" href="styles/manage.css"> <!-- Link to the CSS file -->
</head>
<body>

<div class="container">
    <h1>Manage Job Applications</h1>

    <?php if (isset($success_message)): ?>
        <div class="success-message"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <div class="filters">
        <form method="GET" action="manage.php">
            <label>Filter by Job Reference:</label>
            <input type="text" name="job_ref" placeholder="Enter job reference">
            <button type="submit">Search</button>
        </form>

        <form method="GET" action="manage.php">
            <label>Filter by Applicant Name:</label>
            <input type="text" name="name" placeholder="Enter applicant name">
            <button type="submit">Search</button>
        </form>

        <form method="GET" action="manage.php">
            <button type="submit" class="list-all">List All EOIs</button>
        </form>

        <form method="POST" action="delete_eoi.php">
            <label>Delete EOIs by Job Reference:</label>
            <input type="text" name="job_ref" placeholder="Enter job reference">
            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete all EOIs for this job reference?')">Delete</button>
        </form>
    </div>

    <?php
    $filter = "";
    if (isset($_GET['job_ref'])) {
        $jobRef = $conn->real_escape_string($_GET['job_ref']);
        $filter = "WHERE JobRef = '$jobRef'";
    } elseif (isset($_GET['name'])) {
        $name = $conn->real_escape_string($_GET['name']);
        $filter = "WHERE FirstName LIKE '%$name%' OR LastName LIKE '%$name%'";
    }

    $query = "SELECT * FROM eoi $filter ORDER BY EOInumber DESC";
    $result = $conn->query($query);
    ?>

    <table>
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
                <td><?= htmlspecialchars($row['EOInumber']) ?></td>
                <td><?= htmlspecialchars($row['JobRef']) ?></td>
                <td><?= htmlspecialchars($row['FirstName'] . " " . $row['LastName']) ?></td>
                <td><?= htmlspecialchars($row['Email']) ?></td>
                <td><?= htmlspecialchars($row['Phone']) ?></td>
                <td><?= htmlspecialchars($row['Status']) ?></td>
                <td>
                    <form method="POST" action="update_status.php">
                        <input type="hidden" name="eoi_number" value="<?= $row['EOInumber'] ?>">
                        <select name="status">
                            <option value="New" <?= $row['Status'] == "New" ? "selected" : "" ?>>New</option>
                            <option value="Current" <?= $row['Status'] == "Current" ? "selected" : "" ?>>Current</option>
                            <option value="Final" <?= $row['Status'] == "Final" ? "selected" : "" ?>>Final</option>
                        </select>
                        <button type="submit" class="update-btn">Update</button>
                    </form>
                </td>
                <td>
                    <form method="POST" action="delete_eoi.php">
                        <input type="hidden" name="eoi_number" value="<?= $row['EOInumber'] ?>">
                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this EOI?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include 'footer.inc'; ?>

</body>
</html>
