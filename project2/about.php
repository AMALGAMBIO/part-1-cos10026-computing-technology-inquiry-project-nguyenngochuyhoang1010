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
            <a href="index.php">Home</a>
        </nav>
    </header>

    <div class="container">
        <h2>Our Team</h2>
        <p><a href="mailto:thechillguys@gmail.com">Contact us!</a></p>
        <p class="group-name">We are "The Chill Guys"!</p>

        <div class="team">
            <?php
            $team_members = [
                ["name" => "Bui The Nam", "role" => "apply.php and enhancements.php"],
                ["name" => "Cao Viet Anh", "role" => "jobs.php"],
                ["name" => "Nguyen Minh Thuan", "role" => "about.php"],
                ["name" => "Nguyen Ngoc Huy Hoang", "role" => "index.php and style.css"]
            ];
            
            foreach ($team_members as $member) {
                echo '<div class="team-member">';
                echo '<figure>';
                echo '<img src="https://media.discordapp.net/attachments/1246979738057314374/1310354506457813092/wesh-cat.gif?ex=67b05c7b&is=67af0afb&hm=54a245935846e6c66a719943460e246f5d1fcde8d7720c64b5e3d1c4fa3b87e6&=&width=160&height=160" alt="Team Member">';
                echo '<figcaption>' . htmlspecialchars($member["name"]) . '</figcaption>';
                echo '</figure>';
                echo '<dl>';
                echo '<dt>' . htmlspecialchars($member["name"]) . '</dt>';
                echo '<dd>Hello, I made ' . htmlspecialchars($member["role"]) . '.</dd>';
                echo '</dl>';
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
</body>
</html>