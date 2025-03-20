<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhancements</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <?php include 'header.inc'; ?>
    <?php include 'menu.php'; ?>

    <div class="enhancements-container">
        <h1>Enhancements</h1>
        <p>Here are some additional enhancements implemented for the website.</p>

        <section class="enhancement">
            <h2>1. CSS Animations & Transitions</h2>
            <p>We have added hover effects and transitions for a better user experience.</p>
            <p><strong>Code Used:</strong></p>
            <div class="code-block">
                <pre>
button:hover {
    background-color: #4CAF50;
    transition: background-color 0.3s ease-in-out;
}
                </pre>
            </div>
            <p>Example applied: <a href="apply.php">Apply Page</a></p>
        </section>

        <section class="enhancement">
            <h2>2. Responsive Design</h2>
            <p>The site is optimized for mobile and tablet views.</p>
            <p><strong>Code Used:</strong></p>
            <div class="code-block">
                <pre>
@media (max-width: 768px) {
    body {
        font-size: 14px;
    }
    nav ul {
        display: block;
        text-align: center;
    }
}
                </pre>
            </div>
            <p>Example applied: <a href="index.php">Home Page</a></p>

            <p>See more updates: <a href ="enhancement2.php">Second Update</a> <a href ="phpenhancement.php">System Update</a></p>
        </section>
    </div>

    <?php include 'footer.inc'; ?>

</body>
</html>
