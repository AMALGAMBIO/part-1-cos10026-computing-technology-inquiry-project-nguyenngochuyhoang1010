<?php include 'header.inc'; ?>
<?php include 'menu.inc'; ?>

<section class="search">
    <h2>Find Your Dream Job</h2>
    <form action="jobs.php" method="get">
        <input type="text" name="keywords" placeholder="Keywords">
        <input type="text" name="location" placeholder="Location">
        <input type="text" name="company" placeholder="Company">
        <button type="submit">Search</button>
    </form>
</section>

<?php include 'footer.inc'; ?>