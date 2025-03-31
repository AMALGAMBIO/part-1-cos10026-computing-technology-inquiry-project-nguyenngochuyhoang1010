<?php include_once "header.inc"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search Portal</title>
    <link rel="stylesheet" href="styles/indexstyle.css">
</head>
<body>
    <nav class="topbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="jobs.php">Jobs</a></li>
            <li><a href="enhancement.php">Updates</a></li>
            <li><a href="about.php">About Us</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to Our Job Search Portal</h1>
        <p>Your gateway to exciting career opportunities. Whether you're a job seeker looking for your dream job or a company searching for the right talent, we are here to help.</p>
        <a href="jobs.php" class="cta-button">Browse Jobs</a>
    </section>

    <!-- What We Offer Section -->
    <section class="about-container">
        <h2>What We Offer</h2>
        <p>Our platform connects job seekers with top companies across various industries. We provide an easy-to-use job search experience with advanced filtering options to find jobs that match your skills and preferences.</p>
        
        <ul class="about-list">
            <li>🔍 <span>Find job opportunities</span> that match your skills</li>
            <li>🏢 <span>Discover companies</span> looking for top talent</li>
            <li>📄 <span>Submit applications</span> quickly and efficiently</li>
            <li>🚀 <span>Stay updated</span> with the latest job market trends</li>
        </ul>
    </section>

    <?php include_once "footer.inc"; ?>
</body>
</html>

