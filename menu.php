<link rel="stylesheet" href="stylemenu.css">

<nav class="navbar">
    <button class="menu-btn" onclick="toggleMenu()">☰</button>
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
        menu.classList.toggle("show-menu");
    }

    // Close menu when clicking outside
    document.addEventListener("click", function(event) {
        var menu = document.getElementById("menu-box");
        var button = document.querySelector(".menu-btn");
        if (!menu.contains(event.target) && !button.contains(event.target)) {
            menu.classList.remove("show-menu");
        }
    });
</script>


