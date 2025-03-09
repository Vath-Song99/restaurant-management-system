# 🍽️ Restaurant Management System (RMS)

A simple **Restaurant Management System** built with **PHP (MVC Pattern)** and **MySQL**, designed for handling restaurant menus, orders, and user management.

---

## 📂 Project Structure
```restaurant-management-system/ 
│── public/ # Public-facing files (entry point) 
│ ├── index.php # Main entry file 
│ ├── assets/ # Static files (CSS, JS, Images) 
│── config/ # Configuration files 
│ ├── database.php # Database connection 
│ ├── config.php # General app settings 
│── controllers/ # Business logic (Handle requests) 
│ ├── UserController.php 
│ ├── MenuController.php 
│ ├── OrderController.php 
​​​​​​​│── models/ # Database models 
​​​​​​​│ ├── User.php 
​​​​​​​│ ├── Menu.php 
​​​​​​​│ ├── Order.php 
​​​​​​​│── views/ # UI templates (HTML + PHP) 
​​​​​​​│ ├── includes/ # Common UI components 
│ ├──  ├── header.php 
│ ├──  ├── footer.php 
│ ├── home.php 
│ ├── menu.php 
│ ├── orders.php 
│── routes/ # Routing system 
│ ├── web.php # Define routes 
│── admin/ # Admin dashboard 
│ ├── dashboard.php 
│── logs/ # Log files (errors, transactions) 
│── .htaccess # URL rewriting 
│── README.md # Documentation
```
## 🚀 Getting Started

### 1️⃣ **Clone the Repository**
```sh
git clone https://github.com/Vath-Song99/restaurant-management-system.git
cd restaurant-management-system
2️⃣ Setup Database
Create a MySQL database named RMSDB.
Import the database from database/RMSDB.sql.
3️⃣ Configure Database Connection
Update config/database.php with your database credentials:

php
Copy
Edit
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "RMSDB";
$conn = new mysqli($host, $user, $pass, $dbname);
4️⃣ Start Development Server
If using XAMPP, move the project to htdocs/ and start Apache & MySQL.
Or use PHP's built-in server:

sh
Copy
Edit
php -S localhost:8000 -t public/ 
Now, visit:

bash
Copy
Edit
http://localhost:8000/index.php?page=menu
📌 Features
✅ Menu Management - View available dishes
✅ Order Handling - Process customer orders
✅ User Authentication (Admin Panel)
✅ Simple Routing System (routes/web.php)

🛠️ Built With
PHP (Server-side logic)
MySQL (Database)
HTML + CSS + JavaScript (Frontend)
Apache/XAMPP (Local Development)
📝 License
This project is open-source and free to use under the MIT License.

📧 Need Help?
If you have any questions, feel free to open an issue or reach out to me! 🚀

---