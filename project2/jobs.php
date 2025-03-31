<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="styles/style.css"> <!-- Link to external CSS -->
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
            max-width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .apply-btn {
            display: inline-block;
            padding: 8px 12px;
            color: white;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .apply-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Job Listings</h1>
    
    <?php
    $host = "feenix-mariadb.swin.edu.au";
    $user = "s105550173";
    $pwd = "Nam105550173";
    $sql_db = "s105550173_db";

    $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if ($dbconn) {
        $query = "SELECT * FROM jobs";
        $result = mysqli_query($dbconn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Job ID</th>
                    <th>Reference Number</th>
                    <th>Job Title</th>
                    <th>Description</th>
                    <th>Salary</th>
                    <th>Responsibilities</th>
                    <th>Essential Skills</th>
                    <th>Nice-to-have Skills</th>
                    <th>Action</th>
                  </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ref_num']) . "</td>";
                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>$" . htmlspecialchars($row['salary']) . "</td>";
                echo "<td>" . htmlspecialchars($row['job_respon']) . "</td>";
                echo "<td>" . htmlspecialchars($row['main_skills']) . "</td>";
                echo "<td>" . htmlspecialchars($row['other_skills']) . "</td>";
                echo "<td><a class='apply-btn' href='apply.php?job_ref=" . urlencode($row['ref_num']) . "'>Apply Now</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='text-align: center; color: red;'>There are no jobs available at the moment.</p>";
        }
        mysqli_close($dbconn);
    } else {
        echo "<p style='text-align: center; color: red;'>Unable to connect to the database.</p>";
    }
    ?>

</div>

</body>
</html>

