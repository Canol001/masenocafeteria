<?php
// users.php - Display all registered users with sidebar dropdown
include 'db_connect.php';

// Fetch users
$query = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users - Maseno Cafeteria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
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
        .dropdown-toggle::after {
            float: right;
            margin-top: 6px;
        }
        .list-unstyled {
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Maseno Cafeteria</h4>
        <a href="home.php">🏠 Home</a>

        <!-- Users Dropdown -->
        <div class="dropdown">
            <a href="#usersSubmenu" data-toggle="collapse" class="dropdown-toggle">👥 Users</a>
            <ul class="collapse list-unstyled" id="usersSubmenu">
                <li><a href="users.php" class="pl-4">📋 All Users</a></li>
                <li><a href="add_user.php" class="pl-4">➕ Add User</a></li>
                <li><a href="edit_user.php" class="pl-4">✏️ Edit User</a></li>
                <li><a href="delete_user.php" class="pl-4">🗑️ Remove User</a></li>
            </ul>
        </div>

        <a href="menu.php">🍽️ Menu</a>
        <a href="drinks.php">🥤 Drinks</a>
        <a href="snacks.php">🍟 Snacks</a>
        <a href="orders.php">🧾 Orders</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h3 class="mb-4">📋 Registered Users</h3>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 1;
                while($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['role']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
