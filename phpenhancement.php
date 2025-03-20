<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Enhancements</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'header.inc'; ?>
    <?php include 'menu.inc'; ?>

    <div class="enhancements-container">
        <h1>PHP Enhancements</h1>
        <p>This page describes the PHP-specific enhancements implemented in the job portal.</p>

        <section class="enhancement">
            <h2>1. Form Validation with PHP</h2>
            <p>We have implemented robust form validation for the job application form using PHP.</p>
            <p><strong>Code Used:</strong></p>
            <div class="code-block">
                <pre>
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $error = "Name is required";
    } else {
        $name = htmlspecialchars($_POST["name"]);
    }
}
                </pre>
            </div>
            <p>Example applied: <a href="apply.php">Apply Page</a></p>
        </section>

        <section class="enhancement">
            <h2>2. Session Management</h2>
            <p>User sessions are used to maintain login state across pages.</p>
            <p><strong>Code Used:</strong></p>
            <div class="code-block">
                <pre>
session_start();
$_SESSION["user"] = "John Doe";
echo "Welcome, " . $_SESSION["user"];
                </pre>
            </div>
            <p>Example applied: <a href="index.php">Home Page</a></p>
        </section>
    </div>

    <?php include 'footer.inc'; ?>

</body>
</html>