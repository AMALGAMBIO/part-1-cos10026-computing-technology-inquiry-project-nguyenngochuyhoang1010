<?php
require_once "settings.php";

session_start();
if (!isset($_SESSION['is_manager']) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Status update handling
    if (isset($_POST['eoi_number'], $_POST['status'])) {
        $eoiNumber = (int)$_POST['eoi_number'];
        $status = $conn->real_escape_string($_POST['status']);
        
        $sql = "UPDATE eoi SET Status = '$status' WHERE EOInumber = $eoiNumber";
        $conn->query($sql);
        header("Location: manage.php?update=success");
        exit();
    }
    elseif (isset($_POST['bulk_delete_job_ref'])) {
        $jobRef = $conn->real_escape_string($_POST['bulk_delete_job_ref']);
        $sql = "DELETE FROM eoi WHERE JobRef = '$jobRef'";
        $conn->query($sql);
        header("Location: manage.php?delete=success");
        exit();
    }
}

$filter = "";
if (isset($_GET['job_ref']) && !empty($_GET['job_ref'])) {
    $jobRef = $conn->real_escape_string($_GET['job_ref']);
    $filter = "WHERE JobRef = '$jobRef'";
} elseif (isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $conn->real_escape_string($_GET['name']);
    $filter = "WHERE FirstName LIKE '%$name%' OR LastName LIKE '%$name%'";
}
$query = "SELECT * FROM eoi $filter ORDER BY EOInumber DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Job Applications</title>
</head>
<body>

<h1>Manage Job Applications</h1>

<?php
if (isset($_GET['update']) {
    echo "<p>Status updated successfully!</p>";
}
if (isset($_GET['delete'])) {
    echo "<p>Records deleted successfully!</p>";
}
?>

<!-- Search Forms -->
<form method="GET" action="manage.php">
    <fieldset>
        <legend>Search Filters</legend>
        <div>
            <label>Job Reference:
                <input type="text" name="job_ref" pattern="[A-Za-z0-9]{5}">
            </label>
            <button type="submit">Search</button>
        </div>
        
        <div>
            <label>Applicant Name:
                <input type="text" name="name">
            </label>
            <button type="submit">Search</button>
        </div>
        
        <div>
            <button type="submit" name="show_all" value="1">Show All EOIs</button>
        </div>
    </fieldset>
</form>

<form method="POST" action="manage.php">
    <fieldset>
        <legend>Bulk Actions</legend>
        <label>Delete All EOIs for Job Reference:
            <input type="text" name="bulk_delete_job_ref" required pattern="[A-Za-z0-9]{5}">
        </label>
        <button type="submit" onclick="return confirm('Delete ALL applications for this job?')">
            Delete All
        </button>
    </fieldset>
</form>

<?php if ($result && $result->num_rows > 0): ?>
    <table border="1">
        <thead>
            <tr>
                <th>EOI Number</th>
                <th>Job Ref</th>
                <th>Applicant</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['EOInumber']) ?></td>
                    <td><?= htmlspecialchars($row['JobRef']) ?></td>
                    <td><?= htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']) ?></td>
                    <td><?= htmlspecialchars($row['Email']) ?></td>
                    <td><?= htmlspecialchars($row['Phone']) ?></td>
                    <td>
                        <form method="POST" action="manage.php">
                            <input type="hidden" name="eoi_number" value="<?= $row['EOInumber'] ?>">
                            <select name="status">
                                <option value="New" <?= $row['Status'] == 'New' ? 'selected' : '' ?>>New</option>
                                <option value="Current" <?= $row['Status'] == 'Current' ? 'selected' : '' ?>>Current</option>
                                <option value="Final" <?= $row['Status'] == 'Final' ? 'selected' : '' ?>>Final</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="manage.php">
                            <input type="hidden" name="eoi_number" value="<?= $row['EOInumber'] ?>">
                            <button type="submit" name="delete" onclick="return confirm('Delete this application?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No EOIs found matching your criteria.</p>
<?php endif; ?>

</body>
</html>
