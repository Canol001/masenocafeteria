<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

require 'db_connect.php';

// Fetch categories
$result = $conn->query("SELECT DISTINCT category FROM menu_items");
$categories = $result->fetch_all(MYSQLI_ASSOC);

// Fetch menu items (filter by category if selected)
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$query = "SELECT id, name, description, price, image, category FROM menu_items";
if ($category_filter) {
    $stmt = $conn->prepare($query . " WHERE category = ?");
    $stmt->bind_param("s", $category_filter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($query);
}
$menu_items = $result->fetch_all(MYSQLI_ASSOC);
if ($category_filter) {
    $stmt->close();
}

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Maseno University Cafeteria</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
         .header {
            background: linear-gradient(90deg, #ff6f00, #ff8c00);
            color: white;
            padding: 15px 60px;
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar h1 {
            font-size: 28px;
            font-weight: 700;
        }

        .navbar nav {
            display: flex;
            gap: 25px;
        }

        .navbar nav a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar nav a:hover {
            color: #ffe082;
        }

        .btn-primary {
            background-color: #ff8c00;
            border-color: #ff8c00;
        }
        .btn-primary:hover {
            background-color: #e07b00;
            border-color: #e07b00;
        }
        .card {
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .category-btn {
            margin: 5px;
        }
        .category-btn.active {
            background-color: #e07b00;
            border-color: #e07b00;
        }
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .navbar nav {
                gap: 15px;
            }

            .header {
                padding: 10px 20px;
            }

            .dashboard-container {
                padding: 10px;
            }

            .dashboard-section {
                padding: 20px;
            }

            .profile-overview {
                flex-direction: column;
                text-align: center;
            }

            .order-history table {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .navbar h1 {
                font-size: 24px;
            }

            .dashboard-section h2 {
                font-size: 20px;
            }

            .profile-overview img {
                width: 80px;
                height: 80px;
            }

            .quick-order button, .account-settings button {
                font-size: 14px;
            }
        }

    </style>
</head>
<body>
    <header class="header">
        <div class="navbar">
            <h1>Maseno University Cafeteria</h1>
            <nav>
                <a href="customer_dashboard.php">Dashboard</a>
                <a href="shop.php">Menu</a>
                <a href="cart.php">Cart</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>


    <!-- Shop Content -->
    <div class="container my-5">
        <!-- Messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type'] === 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>

        <!-- Category Filter -->
        <div class="d-flex flex-wrap mb-4">
            <a href="shop.php" class="btn btn-primary category-btn <?php echo !$category_filter ? 'active' : ''; ?>">All</a>
            <?php foreach ($categories as $category): ?>
                <a href="shop.php?category=<?php echo urlencode($category['category']); ?>" 
                   class="btn btn-primary category-btn <?php echo $category_filter === $category['category'] ? 'active' : ''; ?>">
                    <?php echo htmlspecialchars($category['category']); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Menu Items Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php if (empty($menu_items)): ?>
                <div class="col">
                    <p>No items available in this category. <?php echo count($menu_items); ?> items found.</p>
                </div>
            <?php else: ?>
                <?php foreach ($menu_items as $item): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                <p class="card-text flex-grow-1"><?php echo htmlspecialchars($item['description']); ?></p>
                                <h6 class="card-subtitle mb-2 text-warning">KES <?php echo number_format($item['price'], 2); ?></h6>
                                <form action="add_to_cart.php" method="POST">
                                    <input type="hidden" name="menu_item_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="btn btn-primary mt-auto">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php if (!empty($menu_items)): ?>
            <p class="text-center mt-4">Total items: <?php echo count($menu_items); ?></p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script>
        const menuIcon = document.getElementById('menuIcon');
const navLinks = document.getElementById('navLinks');

menuIcon.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

    </script>
</body>
</html>