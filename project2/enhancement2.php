<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Enhancements</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/stylemenu.css">
</head>
<body>

    <?php include 'header.inc'; ?>
    <?php include 'menu.php'; ?>

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
    echo "&lt;li&gt;" . htmlspecialchars($row["title"]) . "&lt;/li&gt;";
}
                </pre>
            </div>
            <p>Example applied: <a href="jobs.php">Jobs Page</a></p>
        </section>

        <section class="enhancement">
            <h2>3. Sidebar Navigation Menu</h2>
            <p>A sliding sidebar menu allows users to navigate seamlessly across pages.</p>
            <p><strong>Code Used:</strong></p>
            <div class="code-block">
                <pre>
function toggleMenu() {
    var menu = document.getElementById("menu-box");
    menu.classList.toggle("show-menu");
}

document.addEventListener("click", function(event) {
    var menu = document.getElementById("menu-box");
    var button = document.querySelector(".menu-btn");
    if (!menu.contains(event.target) && !button.contains(event.target)) {
        menu.classList.remove("show-menu");
    }
});
                </pre>
            </div>
            <p>Example applied: <a href="jobs.php">Jobs Page</a></p>
        </section>

        <section class="enhancement">
            <h2>4. Secure Database Queries</h2>
            <p>All database queries now use prepared statements to prevent SQL injection.</p>
            <p><strong>Code Used:</strong></p>
            <div class="code-block">
                <pre>
$stmt = $conn->prepare("SELECT * FROM jobs WHERE ref_num = ?");
$stmt->bind_param("s", $jobRef);
$stmt->execute();
$result = $stmt->get_result();
                </pre>
            </div>
            <p>Example applied: <a href="jobs.php">Jobs Page</a></p>
        </section>

        <section class="enhancement">
            <h2>5. Styled Job Listings & Apply Button</h2>
            <p>Jobs now have an "Apply Now" button styled for better usability.</p>
            <p><strong>Code Used:</strong></p>
            <div class="code-block">
                <pre>
echo "&lt;td&gt;&lt;a class='apply-btn' href='apply.php?job_ref=" . urlencode($row['ref_num']) . "'&gt;Apply Now&lt;/a&gt;&lt;/td&gt;";
                </pre>
            </div>
            <p>Example applied: <a href="jobs.php">Jobs Page</a></p>
        </section>

        <section class="enhancement">
            <h2>6. Improved Job Listings Layout</h2>
            <p>We redesigned the job listings page to have a more structured, user-friendly layout. Each job now appears in a **single row**, improving readability and navigation.</p>
            <p><strong>Key Features:</strong></p>
            <ul>
                <li>Jobs are displayed as **individual cards** in a vertical layout.</li>
                <li>Each job card includes the **title, description, key skills, and an apply button**.</li>
                <li>Clicking on a job **highlights** it, improving user interaction.</li>
                <li>Smooth **hover effects** and animations for better UI experience.</li>
            </ul>
            <p><strong>Code Used:</strong></p>
            <div class="code-block">
                <pre>
&lt;div class='job-card' onclick='selectJob(this)'&gt;
    &lt;div class='job-info'&gt;
        &lt;div class='job-title'&gt;Senior Developer&lt;/div&gt;
        &lt;div class='job-company'&gt;Exciting startup&lt;/div&gt;
        &lt;div class='job-tags'&gt;
            &lt;span class='tag'&gt;JavaScript&lt;/span&gt;
            &lt;span class='tag'&gt;React&lt;/span&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;a class='apply-btn' href='apply.php?job_ref=123'&gt;Apply&lt;/a&gt;
&lt;/div&gt;
                </pre>
            </div>
            <p>Example applied: <a href="jobs.php">Jobs Page</a></p>
        </section>

    </div>

    <?php include 'footer.inc'; ?>

</body>
</html>

