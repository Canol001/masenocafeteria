<?php
// Database connection
include 'db_connect.php'; // adjust if needed

// Fetch counts
$user_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM users"))[0];
$menu_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM menu_items"))[0];
$order_count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM orders"))[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Maseno Cafeteria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            min-height: 100vh;
            padding-top: 20px;
        }
        .sidebar h4 {
            color: #ecf0f1;
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: #ecf0f1;
            padding: 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        .card-box {
            border: 1px solid #ddd;
            padding: 30px;
            text-align: center;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Maseno Cafeteria</h4>
        <a href="admin_dashboard.php">🏠 Home</a>
        <a href="users.php">👥 Users</a>
        <a href="menu.php">🍽️ Menu</a>
        <a href="drinks.php">🥤 Drinks</a>
        <a href="snacks.php">🍟 Snacks</a>
        <a href="orders.php">🧾 Orders</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <h3>Admin Dashboard</h3>
            <div>
                <a href="add_admin.php" class="btn btn-outline-primary btn-sm">Add New Admin</a>
                <span class="ml-3"><strong>eddy manzi</strong></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card-box">
                    <h5>Users</h5>
                    <h3><?= $user_count ?></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box">
                    <h5>Menus</h5>
                    <h3><?= $menu_count ?></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box">
                    <h5>Orders</h5>
                    <h3><?= $order_count ?></h3>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
