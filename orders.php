<?php
include 'db_connect.php';

// Fetch all orders
$query = mysqli_query($conn, "SELECT * FROM orders");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders - Maseno Cafeteria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            min-height: 100vh;
            padding-top: 20px;
            position: fixed;
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
            margin-left: 260px;
            padding: 20px;
        }
        table {
            background-color: #fff;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Maseno Cafeteria</h4>
        <a href="home.php">🏠 Home</a>
        <a href="users.php">👥 Users</a>
        <a href="menu.php">🍽️ Menu</a>
        <a href="drinks.php">🥤 Drinks</a>
        <a href="snacks.php">🍟 Snacks</a>
        <a href="orders.php">🧾 Orders</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h3>Orders Received</h3>
        <table class="table table-bordered table-striped mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>User ID</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 1;
                while($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><?= htmlspecialchars($row['user_id']) ?></td>
                        <td>KES <?= number_format($row['total']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['order_date']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
