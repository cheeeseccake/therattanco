<?php
require 'db.php';
session_start();
$logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meet Our Founders - The Rattan Co.</title>
    <!-- Google Fonts: Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vina+Sans&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="main-header" id="home">
        <a href="index.php" class="logo" aria-label="Rattan Co. Home">
            <img src="images/logo.png" alt="Rattan Co.">
        </a>

        <button
            class="menu-toggle"
            id="menu-toggle"
            aria-label="Open navigation menu"
            aria-expanded="false"
            aria-controls="primary-nav"
        >
            <i class="fas fa-bars" aria-hidden="true"></i>
        </button>

        <nav class="primary-nav" id="primary-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="catalog.php">Products</a></li>
                <li><a href="#about">Our Story</a></li>
                <li><a href="#artisans">Artisans</a></li>
                <li><a href="#community">Community</a></li>
                <li><a href="#faqs">FAQs</a></li>
            </ul>
        </nav>

        <div class="header-actions">
            <a href="cart.php"
               class="cart-link"
               aria-label="Shopping cart">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                <span class="cart-count" id="cart-count" aria-hidden="true"></span>
            </a>

            <div class="user-menu">
                <button
                    type="button"
                    class="user-btn"
                    id="user-btn"
                    aria-label="Account menu"
                    aria-expanded="false"
                    aria-controls="dropdown-menu"
                >
                    <i class="fas fa-user" aria-hidden="true"></i>
                </button>

                <div class="dropdown-menu" id="dropdown-menu" hidden>
                    <?php if ($logged_in): ?>
                        <div class="dropdown-item">Welcome, <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'User' ?>!</div>
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="logout.php" class="dropdown-item">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="dropdown-item">Login</a>
                        <a href="register.php" class="dropdown-item">Create an account</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Founders Section -->
    <section class="founders-section">
        <h2>Meet Our Founders</h2>
        <div class="founders-grid">
            <div class="founder-card">
                <img src="images/founder1.jpg" alt="Founder 1">
                <h3>John Doe</h3>
                <p>Co-Founder & CEO</p>
                <p>John has over 20 years of experience in sustainable crafts and has dedicated his career to promoting ethical sourcing and traditional craftsmanship.</p>
            </div>
            <div class="founder-card">
                <img src="images/founder2.jpg" alt="Founder 2">
                <h3>Jane Smith</h3>
                <p>Co-Founder & Creative Director</p>
                <p>Jane is passionate about design and sustainability. She leads our design team in creating beautiful, functional pieces that honor traditional techniques.</p>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <button class="floating-back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="js/main.js"></script>

</body>
</html>