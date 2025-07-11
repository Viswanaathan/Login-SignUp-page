<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: /phpproject/Amazon/2nd/2.existing_user.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Amazon Clone</title>
    <link rel="icon" href="../Images/favicon.png" sizes="96x96" type="image/x-icon" />
    <link rel="stylesheet" href="../3rd/page.css" />
</head>

<body>
    <header class="navbar">
        <h2>
            <img src="../Images/Amazon2.png" style="width:15vw; height:5vh;" alt="Amazon-logo">
        </h2>
        <div class="nav-items">
            <span>Hello, <?php echo $_SESSION['username']; ?>!</span>
            <a href="view_cart.php">Orders</a>
            <a href="#" onclick="showWishlistOnly()">Wishlist</a>
            <a href="http://localhost/phpproject/Amazon/3rd/logout.php">Logout</a>
        </div>
    </header>

    <section class="hero">
        <h1>Today's Deals</h1>
        <p>Shop top deals with great discounts!</p>
    </section>

    <main class="product-grid">
        <div class="product-card">
            <form action="cart.php" method="POST" onsubmit="return confirmPurchase(this);">
                <input type="hidden" name="product_name" value="Samsung Galaxy S23">
                <input type="hidden" name="product_price" value="74999">
                <input type="hidden" name="quantity" />
                <span class="heart-icon" onclick="toggleWishlist(this, 'Samsung Galaxy S23')">♡</span>
                <img src="../Images/Phone.png" alt="Smartphone" />
                <h3>Samsung Galaxy S23</h3>
                <p>₹74,999</p>
                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <div class="product-card">
            <form action="cart.php" method="POST" onsubmit="return confirmPurchase(this);">
                <input type="hidden" name="product_name" value="HP Pavilion x360">
                <input type="hidden" name="product_price" value="62499">
                <input type="hidden" name="quantity" />
                <span class="heart-icon" onclick="toggleWishlist(this, 'HP Pavilion x360')">♡</span>
                <img src="../Images/Laptop.png" alt="Laptop" />
                <h3>HP Pavilion x360</h3>
                <p>₹62,499</p>
                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <div class="product-card">
            <form action="cart.php" method="POST" onsubmit="return confirmPurchase(this);">
                <input type="hidden" name="product_name" value="LG 43 4K Smart TV">
                <input type="hidden" name="product_price" value="34990">
                <input type="hidden" name="quantity" />
                <span class="heart-icon" onclick="toggleWishlist(this, 'LG 43 4K Smart TV')">♡</span>
                <img src="../Images/TV.png" alt="Smart TV" />
                <h3>LG 43&quot; 4K Smart TV</h3>
                <p>₹34,990</p>
                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <div class="product-card">
            <form action="cart.php" method="POST" onsubmit="return confirmPurchase(this);">
                <input type="hidden" name="product_name" value="boAt Stone 1200">
                <input type="hidden" name="product_price" value="3499">
                <input type="hidden" name="quantity" />
                <span class="heart-icon" onclick="toggleWishlist(this, 'boAt Stone 1200')">♡</span>
                <img src="../Images/Boat.png" alt="Bluetooth Speaker" />
                <h3>boAt Stone 1200</h3>
                <p>₹3,499</p>
                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <div class="product-card">
            <form action="cart.php" method="POST" onsubmit="return confirmPurchase(this);">
                <input type="hidden" name="product_name" value="IFB 20L Microwave Oven">
                <input type="hidden" name="product_price" value="6999">
                <input type="hidden" name="quantity" />
                <span class="heart-icon" onclick="toggleWishlist(this, 'IFB 20L Microwave Oven')">♡</span>
                <img src="../Images/Oven.png" alt="Microwave Oven" />
                <h3>IFB 20L Microwave Oven</h3>
                <p>₹6,999</p>
                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <div class="product-card">
            <form action="cart.php" method="POST" onsubmit="return confirmPurchase(this);">
                <input type="hidden" name="product_name" value="Samsung 253L Double Door">
                <input type="hidden" name="product_price" value="24990">
                <input type="hidden" name="quantity" />
                <span class="heart-icon" onclick="toggleWishlist(this, 'Samsung 253L Double Door')">♡</span>
                <img src="../Images/Fridge.png" alt="Refrigerator" />
                <h3>Samsung 253L Double Door</h3>
                <p>₹24,990</p>
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    </main>

    <footer>
        <div class="box2">
            <div class="box3">
                <a href="">Conditions of use</a>
                <a href="">Privacy Notice</a>
                <a href="">Help</a>
            </div>
            <div class="box4">
                <p>© 1996–2025, Amazon.com, Inc. or its affiliates</p>
            </div>
        </div>
    </footer>

    <script>
        const wishlistKey = 'wishlistItems';
        let showingWishlistOnly = false;
        function toggleWishlist(el, name) {
            const list = new Set(JSON.parse(localStorage.getItem(wishlistKey)) || []);
            if (list.has(name)) {
                list.delete(name);
                el.classList.remove('filled');
                el.textContent = '♡';
            } else {
                list.add(name);
                el.classList.add('filled');
                el.textContent = '♥';
            }
            localStorage.setItem(wishlistKey, JSON.stringify([...list]));
        }

        function loadWishlist() {
            const list = new Set(JSON.parse(localStorage.getItem(wishlistKey)) || []);
            document.querySelectorAll('.product-card').forEach(card => {
                const name = card.querySelector('input[name="product_name"]').value;
                const icon = card.querySelector('.heart-icon');
                if (list.has(name)) {
                    icon.classList.add('filled');
                    icon.textContent = '♥';
                }
            });
        }

        function showWishlistOnly() {
            const list = new Set(JSON.parse(localStorage.getItem(wishlistKey)) || []);
            const cards = document.querySelectorAll('.product-card');
            const navLink = document.querySelector('.nav-items a[href="#"]');

            showingWishlistOnly = !showingWishlistOnly;

            cards.forEach(card => {
                const name = card.querySelector('input[name="product_name"]').value;
                if (showingWishlistOnly) {
                    card.style.display = list.has(name) ? '' : 'none';
                } else {
                    card.style.display = '';
                }
            });

            if (navLink) {
                navLink.textContent = showingWishlistOnly ? 'Show All' : 'Wishlist';
            }
        }
        function confirmPurchase(form) {
            const name = form.querySelector('input[name="product_name"]').value;
            if (!confirm(`Are you sure you want to buy "${name}"?`)) return false;
            const qty = prompt("Enter quantity:", "1");
            if (!qty || isNaN(qty) || Number(qty) <= 0) {
                alert("Please enter a valid quantity.");
                return false;
            }
            form.querySelector('input[name="quantity"]').value = parseInt(qty);
            return true;
        }
        document.addEventListener('DOMContentLoaded', loadWishlist);
    </script>
</body>

</html>