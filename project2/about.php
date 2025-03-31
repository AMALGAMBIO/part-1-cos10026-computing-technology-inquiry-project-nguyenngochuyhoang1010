<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - The Chill Guys</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <h1>About Us</h1>
        <dl class="group-name">
            <dt>Group Name:</dt>
            <dd>The Chill Guys</dd>
        </dl>
        <nav>
            <a href="index.php">Home</a> |
            <a href="manage.php">Manage Applications</a> <!-- Link to manage.php -->
        </nav>
    </header>
    <?php include 'menu.php'; ?>

    <div class="container">
        <h2>Our Team</h2>
        <p><a href="mailto:thechillguys@gmail.com">Contact us!</a></p>
        <p class="group-name">We are "The Chill Guys"!</p>

        <div class="team">
            <?php
            $team_members = [
                ["name" => "Bui The Nam", "role" => "apply.php and process_eoi.php", "image" => "images/nambuithe.jpg"],
                ["name" => "Cao Viet Anh", "role" => "jobs.php", "image" => "images/cao_viet_anh.jpg"],
                ["name" => "Nguyen Minh Thuan", "role" => "about.php", "image" => "images/nguyen_minh_thuan.jpg"],
                ["name" => "Nguyen Ngoc Huy Hoang", "role" => "index.php, enhancements.php and style.css", "image" => "images/nguyen_ngoc_huy_hoang.jpg"]
            ];
            
            foreach ($team_members as $member) {
                echo '<div class="team-member">';
                echo '<figure>';
                echo '<img src="' . htmlspecialchars($member["image"]) . '" alt="' . htmlspecialchars($member["name"]) . '" width="160" height="160">';
                echo '<figcaption>' . htmlspecialchars($member["name"]) . '</figcaption>';
                echo '</figure>';
                echo '<p>Hello, I made ' . htmlspecialchars($member["role"]) . '.</p>'; // Single line
                echo '</div>';
            }
            ?>
        </div>

        <h2>Our Tutor</h2>
        <dl>
            <dt>Trung Nguyen</dt>
            <dd>Our tutor for this course. Thank you for guiding us!</dd>
        </dl>

        <h2>Our Timetable</h2>
        <table class="timetable">
            <tr>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
            </tr>
            <tr>
                <td>COS10026</td>
                <td> </td>
                <td>TNE10006</td>
                <td> </td>
                <td>STA10003</td>
                <td> </td>
                <td> </td>
            </tr>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td>Vovinam</td>
                <td> </td>
                <td> </td>
            </tr>
        </table>
    </div>
    <?php include_once "footer.inc"; ?>
</body>
</html>

