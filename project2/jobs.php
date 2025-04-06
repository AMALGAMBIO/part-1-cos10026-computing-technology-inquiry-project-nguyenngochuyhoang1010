<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="styles/style.css"> <!-- External CSS -->
    <link rel="stylesheet" href="styles/stylemenu.css"> <!-- Menu Styling -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
            background-image: url('images/background.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #ffffff; /* Fallback color */
            min-height: 100vh;
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
        .job-listings {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }
        .job-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid transparent;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            cursor: pointer;
        }
        .job-card:hover, .job-card.selected {
            border-color: red;
            box-shadow: 0px 6px 12px rgba(255, 0, 0, 0.2);
        }
        .job-info {
            flex-grow: 1;
        }
        .job-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .job-company {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }
        .job-tags {
            display: flex;
            gap: 5px;
            margin-top: 5px;
        }
        .tag {
            background: #eee;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }
        .apply-btn {
            padding: 8px 12px;
            color: white;
            background-color: red;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: 0.3s;
        }
        .apply-btn:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
    <h1>Job Listings</h1>
    
    <div class="job-listings">
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
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='job-card' onclick='selectJob(this)'>";
                    echo "<div class='job-info'>";
                    echo "<div class='job-title'>" . htmlspecialchars($row['title']) . "</div>";
                    echo "<div class='job-ref'>" . htmlspecialchars($row['ref_num']) . "</div>";
                    echo "<div class='job-company'>" . htmlspecialchars($row['description']) . "</div>";
                    echo "<div class='job-tags'>
                            <span class='tag'>" . htmlspecialchars($row['main_skills']) . "</span>
                            <span class='tag'>" . htmlspecialchars($row['other_skills']) . "</span>
                          </div>";
                    echo "</div>";
                    echo "<a class='apply-btn' href='apply.php?'>Apply</a>";
                    echo "</div>";
                }
            } else {
                echo "<p style='text-align: center; color: red;'>There are no jobs available at the moment.</p>";
            }
            mysqli_close($dbconn);
        } else {
            echo "<p style='text-align: center; color: red;'>Unable to connect to the database.</p>";
        }
        ?>
    </div>
</div>

<script>
    function selectJob(element) {
        document.querySelectorAll(".job-card").forEach(card => card.classList.remove("selected"));
        element.classList.add("selected");
    }
</script>

<?php include_once "footer.inc"; ?>
</body>
</html>


