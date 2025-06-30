# 🧁 Cafeteria Management System

A complete web-based Cafeteria Ordering System built using **PHP + MySQL**, featuring both **Admin** and **Customer** interfaces. Users can sign up, browse the menu, add items to their cart, checkout, and receive a confirmation. Admins can manage orders, menus, and users through a separate dashboard.

---

## 🔧 Tech Stack

| Layer      | Technology         |
|------------|--------------------|
| Frontend   | HTML, CSS, Bootstrap |
| Backend    | PHP (Pure PHP)     |
| Database   | MySQL (SQL dump included) |

---

## 🚀 Features

### 👨‍🍳 Customer Side
- 👤 Sign up / Log in
- 🍔 Browse menu items
- 🛒 Add to cart
- 💳 Checkout with summary
- ✅ Thank you page after order
- 📦 View order history (optional)

### 🛠️ Admin Side
- 🔐 Admin login
- 🧾 Manage orders
- 🍱 View and edit menu
- 👥 View registered users
- 📊 Dashboard overview

---

## 📁 Project Structure

```
📦 cafeteria-system/
 ┣ 📂images/                # Menu images, UI assets
 ┣ 📂trash/                 # Old/test files (clean later)
 ┣ 📜 INDEDX1.php           # (Possibly outdated or test file)
 ┣ 📜 add_to_cart.php
 ┣ 📜 admin_dashboard.php
 ┣ 📜 admin_login.php
 ┣ 📜 admin_panel.php
 ┣ 📜 cafe.sql              # Database schema
 ┣ 📜 cafe2.sql
 ┣ 📜 cafe3.sql
 ┣ 📜 cart.php
 ┣ 📜 checkout.php
 ┣ 📜 customer_dashboard.php
 ┣ 📜 db_connect.php        # Database connection config
 ┣ 📜 index.php             # Landing page
 ┣ 📜 login.php             # Customer login
 ┣ 📜 logout.php
 ┣ 📜 menu.php              # Menu listing
 ┣ 📜 orders.php
 ┣ 📜 shop.php              # Core shopping interface
 ┣ 📜 signup.php
 ┣ 📜 thank_you.php
 ┣ 📜 users.php
```

---

## 🧠 Getting Started

### 1. Clone the repo

```bash
git clone https://github.com/Canol001/masenocafeteria.git
cd masenocafeteria
```

### 2. Import the SQL Database

1. Open **phpMyAdmin**
2. Create a new database, e.g., `cafeteria`
3. Import `cafe.sql` or `cafe3.sql` (pick the latest/working one)

### 3. Configure DB Connection

Open `db_connect.php` and set your credentials:

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "cafeteria";
```

### 4. Run it locally

Use **XAMPP/Laragon/MAMP** and place the project in `htdocs`, then visit:

```
http://localhost/masenocafeteria/index.php
```

---

## 📸 Screenshots

> (Add screenshots here of the customer dashboard, admin panel, menu UI, etc.)

---

## 🧹 To Do / Improvements

- [ ] Add image upload for menu items
- [ ] Add search/filter for menu
- [ ] Improve cart UX with AJAX
- [ ] Add payment gateway integration
- [ ] Add order status tracking
- [ ] Mobile responsiveness

---

## 🧾 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 🙋‍♂️ Author

Built by **[Canol001](https://github.com/Canol001)**  
Feel free to fork, star ⭐, or contribute!
