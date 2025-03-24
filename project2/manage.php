<?php
require_once "settings.php";

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

<h1>Manage Job Applications</h1>

<form method="GET" action="manage.php">
    <label>Filter by Job Reference:</label>
    <input type="text" name="job_ref">
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
    <input type="text" name="job_ref">
    <button type="submit" onclick="return confirm('Are you sure you want to delete all EOIs for this job reference?')">Delete</button>
</form>

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
            <td><?= $row['EOInumber'] ?></td>
            <td><?= $row['JobRef'] ?></td>
            <td><?= $row['FirstName'] . " " . $row['LastName'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['Phone'] ?></td>
            <td><?= $row['Status'] ?></td>
            <td>
                <form method="POST" action="update_status.php">
                    <input type="hidden" name="eoi_number" value="<?= $row['EOInumber'] ?>">
                    <select name="status">
                        <option value="New" <?= $row['Status'] == "New" ? "selected" : "" ?>>New</option>
                        <option value="Current" <?= $row['Status'] == "Current" ? "selected" : "" ?>>Current</option>
                        <option value="Final" <?= $row['Status'] == "Final" ? "selected" : "" ?>>Final</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
            <td>
                <form method="POST" action="delete_eoi.php">
                    <input type="hidden" name="eoi_number" value="<?= $row['EOInumber'] ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this EOI?')">Delete</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include 'footer.inc'; ?>
