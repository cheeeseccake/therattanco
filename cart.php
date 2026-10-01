<?php
require_once 'classes/Cart.php';
session_start();
$logged_in = isset($_SESSION['user_id']);
$cartObj = new Cart($logged_in ? $_SESSION['user_id'] : null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - The Rattan Co.</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <section class="cart-section">
        <h2>Your Shopping Bag</h2>
        <div class="cart-layout">
            <div class="cart-main" id="cart-items">
                <div class="cart-items"></div>
            </div>
            <aside class="cart-summary">
                <h3>Order Summary</h3>
                <span class="summary-item-count" aria-live="polite"></span>
                <div class="summary-items" id="summary-items"></div>
                <div class="summary-shipping">
                    <span>Shipping</span>
                    <strong>Calculated at checkout</strong>
                </div>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="summary-subtotal">₱0</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span id="summary-total">₱0</span>
                </div>
                <div class="cart-actions">
                    <button onclick="goBack()">Continue Shopping</button>
                    <?php if ($logged_in): ?>
                        <button onclick="checkout()" class="checkout-btn">Proceed to Checkout</button>
                    <?php else: ?>
                        <p class="checkout-prompt">Please <a href="login.php">login</a> or <a href="register.php">register</a> to checkout.</p>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </section>

    <script src="js/main.js"></script>
    <script>
        function loadCart() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartContainer = document.getElementById('cart-items');
            const summaryItems = document.getElementById('summary-items');
            const summarySubtotal = document.getElementById('summary-subtotal');
            const summaryTotal = document.getElementById('summary-total');
            
            if (cart.length === 0) {
                cartContainer.innerHTML = `
                    <div class="cart-empty">
                        <p>Your bag is waiting to be filled.</p>
                        <a href="catalog.php" class="cta-button">Explore the Collection</a>
                    </div>
                `;
                if (summaryItems) summaryItems.innerHTML = '';
                if (summarySubtotal) summarySubtotal.textContent = '₱0';
                if (summaryTotal) summaryTotal.textContent = '₱0';
            } else {
                let html = '<div class="cart-items">';
                let total = 0;
                let summaryHtml = '<div class="summary-item-list">';
                cart.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    const rawImage = item.image || '';
                    let normalizedImage = rawImage;
                    if (normalizedImage.startsWith('/therattanco/')) {
                        normalizedImage = normalizedImage.slice('/therattanco/'.length);
                    }
                    if (normalizedImage && !normalizedImage.startsWith('images/')) {
                        normalizedImage = 'images/' + normalizedImage;
                    }
                    html += `
                        <div class="cart-item" data-index="${index}">
                            <div class="cart-image-wrapper">
                                <img src="${normalizedImage}" alt="${item.name}" class="cart-item-image">
                            </div>
                            <div class="cart-item-details">
                                <div class="product-heading">
                                    <div>
                                        <h4>${item.name}</h4>
                                        <div class="cart-item-meta">
                                            <span>Natural</span>
                                            <span class="meta-separator" aria-hidden="true">•</span>
                                            <span>One Size</span>
                                        </div>
                                    </div>
                                    <span class="product-status">In Stock</span>
                                </div>
                                <div class="product-information">
                                    <span>Natural Woven Fiber</span>
                                    <span>Artisan Collection</span>
                                </div>
                                <a href="catalog.php" class="view-product">View Product →</a>
                            </div>
                            <div class="cart-purchase">
                                <div class="cart-price-row">
                                    <span class="unit-price">₱${item.price.toLocaleString()} × ${item.quantity}</span>
                                    <strong class="item-total">₱${itemTotal.toLocaleString()}</strong>
                                </div>
                                <div class="cart-controls">
                                    <span class="quantity-label">Quantity</span>
                                    <div class="quantity-control">
                                        <button onclick="updateQuantity(${index}, -1)" aria-label="Decrease quantity">−</button>
                                        <span>${item.quantity}</span>
                                        <button onclick="updateQuantity(${index}, 1)" aria-label="Increase quantity">+</button>
                                    </div>
                                </div>
                                <div class="shipping-info">
                                    <span>Delivery</span>
                                    <strong>3–5 Business Days</strong>
                                </div>
                            </div>
                        </div>
                    `;
                    summaryHtml += `
                        <div class="summary-item">
                            <span class="summary-item-name">${item.name} <span class="summary-item-qty">x${item.quantity}</span></span>
                            <span class="summary-item-price">₱${itemTotal.toLocaleString()}</span>
                        </div>
                    `;
                });
                html += '</div>';
                summaryHtml += '</div>';
                cartContainer.innerHTML = html;
                if (summaryItems) summaryItems.innerHTML = summaryHtml;
                
                if (summarySubtotal) summarySubtotal.textContent = '₱' + total.toLocaleString();
                if (summaryTotal) summaryTotal.textContent = '₱' + total.toLocaleString();
                const itemCount = cart.reduce((sum, item) => sum + item.quantity, 0);
                const itemCountEl = document.querySelector('.summary-item-count');
                if (itemCountEl) itemCountEl.textContent = itemCount + ' item' + (itemCount !== 1 ? 's' : '');

                const cartItems = cartContainer.querySelector('.cart-items');
                const allItems = cartItems.querySelectorAll('.cart-item');
                if (allItems.length > 3) {
                    for (let i = 3; i < allItems.length; i++) {
                        allItems[i].classList.add('hidden');
                    }
                    const toggle = document.createElement('button');
                    toggle.className = 'cart-toggle';
                    toggle.type = 'button';
                    toggle.innerHTML = 'Show more <span class="cart-toggle-icon">▼</span>';
                    toggle.addEventListener('click', () => {
                        const isExpanded = cartItems.classList.toggle('expanded');
                        toggle.innerHTML = isExpanded
                            ? 'Show less <span class="cart-toggle-icon">▼</span>'
                            : 'Show more <span class="cart-toggle-icon">▼</span>';
                        for (let i = 3; i < allItems.length; i++) {
                            allItems[i].classList.toggle('hidden', !isExpanded);
                        }
                    });
                    cartItems.after(toggle);
                }
            }
        }

        function updateQuantity(index, change) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            if (cart[index]) {
                cart[index].quantity += change;
                if (cart[index].quantity <= 0) {
                    cart.splice(index, 1);
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCart();
            }
        }

        function removeItem(index) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
        }

        function checkout() {
            window.location.href = 'checkout.php';
        }

        function goBack() {
            window.location.href = 'catalog.php';
        }

        loadCart();
    </script>
</body>
</html>