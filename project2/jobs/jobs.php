<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
require_once "settings.php";
$dbconn = @mysqli_connect($host,$user,$pwd,$sql_db);
if($dbconn) {
    $query = "SELECT * FROM jobs";
    $result = mysqli_query($dbconn, $query);
    if ($result) {
        echo "<table border='1'>";
        echo "<tr>
        <th>Job ID</th>
        <th>Reference Number</th>
        <th>Job Title</th>
        <th>Description</th>
        <th>Salary</th>
        <th>Responsibilities</th>
        <th>Essential Skills</th>
        <th>Nice-to-have Skills</th>
      </tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['ref_num'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['salary'] . "</td>";
            echo "<td>" . $row['job_respon'] . "</td>";
            echo "<td>" . $row['main_skills'] . "</td>";
            echo "<td>" . $row['other_skills'] . "</td>";
            echo "</tr>";
        }
    }
    else {
        echo "There are no jobs on display.";
    }
    mysqli_close($dbconn);
} else echo "<p>Unable to connect to the db.</p>";
?>
</body>
</html>