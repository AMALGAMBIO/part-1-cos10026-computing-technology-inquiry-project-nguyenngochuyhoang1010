<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - The Chill Guys</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        /* Base Reset */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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

        header {
            background: linear-gradient(to right, #6a0dad, #9b59b6);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-bottom: 5px solid #5e00a3;
            position: relative;
        }

        header h1 {
            font-size: 2.8em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .group-name dt {
            color: #ffffff;
            font-weight: bold;
            font-size: 1.1em;
            display: inline;
            margin-right: 8px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
        }

        .group-name dd {
            display: inline;
            font-size: 1.1em;
            color: #ffe6ff;
        }

        header nav {
            margin-top: 20px;
        }

        header a {
            color: #ffffff;
            margin: 0 12px;
            text-decoration: none;
            font-weight: bold;
            position: relative;
            transition: color 0.3s ease;
        }

        header a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            background: #ffffff;
            left: 0;
            bottom: -4px;
            transition: width 0.3s ease;
        }

        header a:hover::after {
            width: 100%;
        }

        header a:hover {
            color: #e0d4ff;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.92);
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
        }

        .container h2 {
            color: #6a0dad;
            text-align: center;
            font-size: 2em;
            margin-bottom: 10px;
        }

        .container p, .group-name {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.1em;
        }

        .divider {
            height: 4px;
            width: 80px;
            background: #6a0dad;
            margin: 20px auto;
            border-radius: 5px;
        }

        .team {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .team-member {
            background: #f6ecff;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(106, 13, 173, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            padding: 20px;
        }

        .team-member:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(106, 13, 173, 0.3);
        }

        .team-member img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .team-member figcaption {
            font-weight: bold;
            font-size: 1.2em;
            color: #6a0dad;
            margin-bottom: 5px;
        }

        .team-member p {
            font-size: 1em;
            color: #444;
        }

        dl {
            text-align: center;
            margin: 30px 0;
        }

        dl dt {
            font-weight: bold;
            font-size: 1.1em;
            color: #6a0dad;
        }

        dl dd {
            color: #000;
        }

        table.timetable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            box-shadow: 0 6px 20px rgba(106, 13, 173, 0.1);
        }

        table.timetable th, table.timetable td {
            border: 1px solid #6a0dad;
            padding: 14px;
            font-size: 1em;
        }

        table.timetable th {
            background-color: #6a0dad;
            color: white;
        }

        table.timetable td {
            background-color: #faf5ff;
        }

        a[href^="mailto:"] {
            color: #6a0dad;
            font-weight: bold;
            text-decoration: none;
        }

        a[href^="mailto:"]:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>About Us</h1>
        <dl class="group-name">
            <dt>Group Name:</dt>
            <dd>The Chill Guys</dd>
        </dl>
        <nav>
            <a href="index.php">Home</a>
            <a href="manage.php">Manage Applications</a>
        </nav>
    </header>

    <?php include 'menu.php'; ?>

    <div class="container">
        <h2>Our Team</h2>
        <div class="divider"></div>
        <p><a href="mailto:thechillguys@gmail.com">Contact us!</a></p>
        <p class="group-name">We are "The Chill Guys"!</p>

        <div class="team">
            <?php
            $team_members = [
                ["name" => "Bui The Nam", "role" => "apply.php, manage.php, process_eoi.php and creating EOI tables", "image" => "images/nambuithe.jpg"],
                ["name" => "Cao Viet Anh", "role" => "jobs.php, manage_jobs.php and other features (delete_eoi.php, update_status.php)", "image" => "images/cao_viet_anh.jpg"],
                ["name" => "Nguyen Ngoc Huy Hoang", "role" => "index.php, enhancements.php and style.css", "image" => "images/nguyen_ngoc_huy_hoang.jpg"]
            ];

            foreach ($team_members as $member) {
                echo '<div class="team-member">';
                echo '<figure>';
                echo '<img src="' . htmlspecialchars($member["image"]) . '" alt="' . htmlspecialchars($member["name"]) . '">';
                echo '<figcaption>' . htmlspecialchars($member["name"]) . '</figcaption>';
                echo '</figure>';
                echo '<p>Hello, I made ' . htmlspecialchars($member["role"]) . '.</p>';
                echo '</div>';
            }
            ?>
        </div>

        <h2>Our Tutor</h2>
        <div class="divider"></div>
        <dl>
            <dt>Trung Nguyen</dt>
        </dl>

        <h2>Our Timetable</h2>
        <div class="divider"></div>
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
                <td></td>
                <td>TNE10006</td>
                <td></td>
                <td>STA10003</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Vovinam</td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

    <?php include_once "footer.inc"; ?>
</body>
</html>
