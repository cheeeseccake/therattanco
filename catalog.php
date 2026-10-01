<?php
require_once 'classes/Product.php';
session_start();
$productObj = new Product();
$categories = $productObj->getCategories();
$logged_in = isset($_SESSION['user_id']);

$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($searchQuery !== '') {
    $products = $productObj->searchProducts($searchQuery);
} elseif ($selectedCategory && in_array($selectedCategory, $categories)) {
    $products = $productObj->getProductsByCategory($selectedCategory);
} else {
    $products = $productObj->getAllProducts();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Collection - The Rattan Co.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/catalog.css">
</head>
<body>
    <div class="catalog-header">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="index.php" class="breadcrumb-link">Home</a>
            <span class="breadcrumb-separator" aria-hidden="true">/</span>
            <span class="breadcrumb-current" aria-current="page">The Collection</span>
        </nav>

        <div class="filter-container">
            <form method="GET" action="catalog.php" class="search-form">
                <input type="text"
                       name="search"
                       placeholder="Search products..."
                       value="<?= htmlspecialchars($searchQuery) ?>"
                       class="search-input">
                <?php if ($selectedCategory): ?>
                    <input type="hidden" name="category" value="<?= htmlspecialchars($selectedCategory) ?>">
                <?php endif; ?>
                <button type="submit" class="search-btn" aria-label="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <div class="filter-group">
                <label for="category-filter">Filter by Category:</label>
                <select id="category-filter" onchange="filterProducts()">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category) ?>" <?= $selectedCategory === $category ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <a href="cart.php" class="cart-link" aria-label="Shopping cart">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                <span class="cart-count" id="cart-count" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    <div class="catalog-intro">
        <h1>The Collection</h1>
        <p>Handwoven rattan pieces crafted with intention. Each item celebrates traditional Filipino craftsmanship and sustainable materials.</p>
    </div>

    <div class="products-meta">
        <span class="product-count"><?= count($products) ?> piece<?= count($products) !== 1 ? 's' : '' ?> to discover</span>
    </div>

    <div class="products-grid">
        <?php if (empty($products)): ?>
            <p class="empty-message">No products found<?= $searchQuery ? ' for "' . htmlspecialchars($searchQuery) . '"' : '' ?>.</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image-wrapper">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['item']) ?>">
                        <span class="product-label">Handwoven</span>
                    </div>
                    <div class="product-info">
                        <h3><?= htmlspecialchars($product['item']) ?></h3>
                        <p><?= htmlspecialchars($product['description']) ?></p>
                        <span class="price">₱<?= number_format($product['price']) ?></span>
                        <div class="button-group">
                            <button class="product-btn add-to-cart" onclick="addToCart('<?= htmlspecialchars($product['item']) ?>', <?= $product['price'] ?>, '<?= htmlspecialchars($product['image']) ?>')">Add to Cart</button>
                            <button class="product-btn buy-now" onclick="buyNow('<?= htmlspecialchars($product['item']) ?>', <?= $product['price'] ?>, '<?= htmlspecialchars($product['image']) ?>')">Buy Now</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script src="js/main.js"></script>
    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function filterProducts() {
            const category = document.getElementById('category-filter').value;
            const search = document.querySelector('.search-input').value;
            const url = new URL(window.location);
            url.searchParams.set('category', category);
            url.searchParams.set('search', search);
            window.location.href = url.toString();
        }

        function addToCart(itemName, price, image) {
            const item = cart.find(i => i.name === itemName);
            if (item) {
                item.quantity += 1;
            } else {
                cart.push({ name: itemName, price: price, quantity: 1, image: image });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartIcon();
            alert(itemName + ' added to cart!');
        }

        function buyNow(itemName, price, image) {
            addToCart(itemName, price, image);
            window.location.href = 'checkout.php';
        }

        function updateCartIcon() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
            const cartCountEl = document.getElementById('cart-count');
            if (cartCountEl) {
                cartCountEl.textContent = cartCount > 0 ? cartCount : '';
            }
        }

        updateCartIcon();
    </script>
</body>
</html>