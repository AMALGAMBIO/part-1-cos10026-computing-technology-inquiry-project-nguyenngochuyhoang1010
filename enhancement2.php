<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Enhancements</title>
    <link rel="stylesheet" href="vscode/styles/styles.css">
</head>
<body>

    <?php include 'header.inc'; ?>
    <?php include 'menu.inc'; ?>

    <div class="enhancements-container">
        <h1>Additional Enhancements</h1>
        <p>This page describes further improvements made to the website.</p>

        <section class="enhancement">
            <h2>1. AJAX for Dynamic Content</h2>
            <p>We use AJAX to dynamically load job listings without reloading the page.</p>
            <p><strong>Code Used:</strong></p>
            <div class="code-block">
                <pre>
function loadJobs() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_jobs.php", true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            document.getElementById("job-listings").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
                </pre>
            </div>
            <p>Example applied: <a href="jobs.php">Jobs Page</a></p>
        </section>

        <section class="enhancement">
            <h2>2. Database-Driven Content</h2>
            <p>Job postings are dynamically retrieved from a database.</p>
            <p><strong>Code Used:</strong></p>
            <div class="code-block">
                <pre>
$conn = new mysqli("localhost", "root", "", "job_portal");
$result = $conn->query("SELECT * FROM jobs");
while ($row = $result->fetch_assoc()) {
    echo "&lt;li&gt;" . $row["title"] . "&lt;/li&gt;";
}
                </pre>
            </div>
            <p>Example applied: <a href="jobs.php">Jobs Page</a></p>
        </section>
    </div>

    <?php include 'footer.inc'; ?>

</body>
</html>
