<link rel="stylesheet" href="style.css">
<nav class="navbar">
    <button class="menu-btn" onclick="toggleMenu()">☰ Menu</button>
    <div id="menu-box" class="menu-box">
        <ul class="menu-list">
            <li><a href="index.php">Home</a></li>
            <li><a href="jobs.php">Jobs</a></li>
            <li><a href="enhancement.php">Enhancements</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="apply.php">Apply</a></li>
        </ul>
    </div>
</nav>

<script>
    function toggleMenu() {
        var menu = document.getElementById("menu-box");
        if (menu.style.display === "block") {
            menu.style.display = "none";
        } else {
            menu.style.display = "block";
        }
    }
</script>
