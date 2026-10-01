
<?php
// Replace this placeholder with your existing cart-count
// variable or cart query when available.
$cartCount = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rattan Co. | Woven Heritage</title>

    <meta name="description"
          content="Discover timeless handwoven rattan pieces and thoughtfully crafted home decor at Rattan Co.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap"
          rel="stylesheet">

    <!-- Font Awesome icons -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Your stylesheet -->
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="main-header" id="home">

    <a href="#home" class="brand" aria-label="Rattan Co. home">
        <i class="fa-brands fa-pagelines brand-icon"
           aria-hidden="true"></i>
        <span>Rattan Co.</span>
    </a>

    <button class="menu-toggle"
            id="menu-toggle"
            aria-label="Open navigation menu"
            aria-expanded="false"
            aria-controls="primary-nav">
        <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>

    <nav class="primary-nav" id="primary-nav">
        <ul>
            <li><a class="nav-link active" href="#home">Home</a></li>
            <li><a class="nav-link" href="catalog.php">Products</a></li>
            <li><a class="nav-link" href="#about">Our Story</a></li>
            <li><a class="nav-link" href="#artisans">Artisans</a></li>
            <li><a class="nav-link" href="#community">Community</a></li>
            <li><a class="nav-link" href="#faqs">FAQs</a></li>
        </ul>
    </nav>

    <div class="header-actions">

        <a href="cart.php"
           class="cart-link"
           aria-label="Shopping cart, <?= (int) $cartCount ?> items">

            <i class="fa-solid fa-bag-shopping"
               aria-hidden="true"></i>

            <?php if ($cartCount > 0): ?>
                <span class="cart-count" aria-hidden="true">
                    <?= (int) $cartCount ?>
                </span>
            <?php endif; ?>
        </a>

        <div class="user-menu">
            <div class="user-dropdown open" id="userDropdown" role="menu">
                <div class="dropdown-header">
                    <div class="dropdown-user-info">
                        <div class="dropdown-avatar" aria-hidden="true">C</div>
                        <div class="dropdown-user-details">
                            <strong>Cheska Bautista</strong>
                            <span>Compliance</span>
                            <div class="account-status">
                                <span class="status-dot"></span>
                                Active
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="user-dropdown-menu">
                    <li>
                        <a href="?page=profile-settings" role="menuitem">
                            <span class="menu-content">
                                <strong>Profile Settings</strong>
                                <small>Manage your account</small>
                            </span>
                            <span class="menu-arrow" aria-hidden="true">›</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=profile-settings#change-password" role="menuitem">
                            <span class="menu-content">
                                <strong>Change Password</strong>
                                <small>Update your password</small>
                            </span>
                            <span class="menu-arrow" aria-hidden="true">›</span>
                        </a>
                    </li>
                    <li class="divider" role="separator"></li>
                    <li>
                        <a href="/auth/logout.php" class="signout-link" role="menuitem">
                            <span class="menu-content">
                                <strong>Sign Out</strong>
                                <small>End your current session</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</header>

<main>

    <!-- HERO -->
    <section class="hero-section" id="hero">

        <div class="hero-image-container">

            <img
                src="images/hero.jpg"
                alt="Beautiful handwoven rattan furniture in a natural, sunlit interior"
                class="hero-image"
                fetchpriority="high"
            >

            <div class="hero-overlay"></div>

            <div class="hero-content">

                <p class="hero-eyebrow">
                    HANDCRAFTED
                    <span>•</span>
                    SUSTAINABLE
                    <span>•</span>
                    TIMELESS
                </p>

                <h1>
                    Woven<br>
                    Heritage<span class="hero-period">.</span>
                </h1>

                <p class="hero-description">
                    Authentic, sustainable crafts for the
                    modern home. Discover the beauty of
                    pieces woven with purpose.
                </p>

                <a href="catalog.php" class="cta-button">
                    Shop the Collection
                    <i class="fa-solid fa-arrow-right"
                       aria-hidden="true"></i>
                </a>

            </div>

            <!-- Bottom feature highlights -->
            <div class="hero-features" id="community">

                <div class="hero-feature" id="artisans">
                    <i class="fa-brands fa-pagelines"
                       aria-hidden="true"></i>
                    <span>
                        Supporting<br>
                        Local Artisans
                    </span>
                </div>

                <div class="hero-feature">
                    <i class="fa-solid fa-leaf"
                       aria-hidden="true"></i>
                    <span>
                        Eco-Friendly<br>
                        Materials
                    </span>
                </div>

                <div class="hero-feature">
                    <i class="fa-solid fa-hands"
                       aria-hidden="true"></i>
                    <span>
                        Handwoven<br>
                        with Care
                    </span>
                </div>

            </div>

        </div>
    </section>

    <!-- Keep or insert your existing sections here.
         Their IDs should match the navigation links. -->

    <section id="about" class="content-anchor">
        <!-- Your existing Our Story section goes here. -->
    </section>

    <section id="faqs" class="content-anchor">
        <!-- Your existing FAQs section goes here. -->
    </section>

</main>

<script src="js/main.js" defer></script>

</body>
</html>