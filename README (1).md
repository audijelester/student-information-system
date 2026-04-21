# Smart Order Management System
### ITEL 203 – Web Systems and Technologies | Group Performance Task #2

---

## 📁 Project Structure

```
smart_oms/
├── index.php                  ← Root redirect
├── login.php                  ← Login page
├── database.sql               ← Run this in phpMyAdmin
├── classes/
│   ├── Database.php           ← Singleton PDO connection
│   ├── User.php               ← User CRUD + password verify
│   ├── Auth.php               ← Login/Logout/Session
│   ├── Customer.php           ← Customer entity (CRUD)
│   └── Order.php              ← Transaction class (CRUD + JOIN)
└── pages/
    ├── header.php             ← Shared navbar/sidebar
    ├── footer.php             ← Shared closing HTML
    ├── dashboard.php          ← Stats + recent orders
    ├── customers.php          ← Customer management (CRUD)
    ├── orders.php             ← Order management (CRUD)
    ├── reports.php            ← JOIN query report table
    ├── users.php              ← User management (admin only)
    ├── about.php              ← Project info page
    ├── developers.php         ← Team members page
    └── logout.php             ← Destroy session
```

---

## ⚙️ Setup Instructions (XAMPP)

### Step 1 – Copy project folder
Place the `smart_oms` folder inside:
```
C:\xampp\htdocs\smart_oms
```

### Step 2 – Start XAMPP
Start **Apache** and **MySQL** from the XAMPP Control Panel.

### Step 3 – Import the database
1. Open your browser → go to `http://localhost/phpmyadmin`
2. Click **New** on the left sidebar
3. Create a database named: `smart_oms`
4. Click the **Import** tab
5. Choose `smart_oms/database.sql`
6. Click **Go**

### Step 4 – Run the app
Open your browser and go to:
```
http://localhost/smart_oms
```

---

## 🔐 Default Login Credentials

| Username | Password   | Role  |
|----------|------------|-------|
| admin    | password   | Admin |
| jsmith   | password   | Staff |
| mreyes   | password   | Staff |

> Passwords are hashed with `password_hash()` in the database.

---

## 🗄️ Database Tables

### Table 1: `users` (authentication)
| Column     | Type         | Description              |
|------------|--------------|--------------------------|
| id         | INT (PK)     | Auto increment           |
| username   | VARCHAR(50)  | Unique login name        |
| email      | VARCHAR(100) | Unique email             |
| password   | VARCHAR(255) | Hashed (password_hash)   |
| role       | ENUM         | 'admin' or 'staff'       |
| created_at | TIMESTAMP    | Auto                     |

### Table 2: `customers` (main entity)
| Column     | Type         | Description              |
|------------|--------------|--------------------------|
| id         | INT (PK)     | Auto increment           |
| name       | VARCHAR(100) | Full name                |
| email      | VARCHAR(100) | Contact email            |
| phone      | VARCHAR(20)  | Phone number             |
| address    | TEXT         | Address                  |
| created_at | TIMESTAMP    | Auto                     |

### Table 3: `orders` (transaction / related)
| Column      | Type           | Description                    |
|-------------|----------------|--------------------------------|
| id          | INT (PK)       | Auto increment                 |
| customer_id | INT (FK)       | References customers.id        |
| user_id     | INT (FK)       | References users.id            |
| product     | VARCHAR(150)   | Product name                   |
| quantity    | INT            | Number of items                |
| total_price | DECIMAL(10,2)  | Total amount                   |
| status      | ENUM           | pending/processing/completed/cancelled |
| created_at  | TIMESTAMP      | Auto                           |

---

## 🔗 Database Relationships

```
users (1) ──────────── (N) orders     [users.id → orders.user_id]
customers (1) ────────── (N) orders   [customers.id → orders.customer_id]
```

**JOIN query used in Reports page:**
```sql
SELECT o.id, c.name AS customer_name, o.product, o.total_price,
       o.status, u.username AS created_by
FROM orders o
JOIN customers c ON o.customer_id = c.id
JOIN users u ON o.user_id = u.id
ORDER BY o.created_at DESC;
```

---

## 🧱 OOP Classes

| Class         | File              | Key Methods                                      |
|---------------|-------------------|--------------------------------------------------|
| Database      | Database.php      | `getInstance()`, `getConnection()`               |
| User          | User.php          | `create()`, `update()`, `delete()`, `getAll()`   |
| Auth          | Auth.php          | `login()`, `logout()`, `isLoggedIn()`, `requireLogin()` |
| Customer      | Customer.php      | `create()`, `update()`, `delete()`, `search()`   |
| Order         | Order.php         | `create()`, `getAllWithDetails()`, `getSummaryStats()` |

---

## 🛡️ Security Features

- ✅ `password_hash()` / `password_verify()` for passwords
- ✅ Session-based authentication on every page
- ✅ `requireLogin()` blocks unauthenticated access
- ✅ PDO prepared statements (prevents SQL injection)
- ✅ `htmlspecialchars()` on all output (prevents XSS)
- ✅ Role-based access (admin-only user management)

---

## 👥 Customize Developers Page

Open `pages/developers.php` and edit the `$developers` array:
```php
$developers = [
    ['name' => 'Your Name Here', 'role' => 'Your Role',
     'contrib' => 'What you contributed', 'github' => 'https://github.com/...', 'initials' => 'YN'],
    // ... add all members
];
```

---

## 🌐 Deploying to InfinityFree

1. Create a free account at infinityfree.com
2. Create a hosting account and note your MySQL host/credentials
3. Update `classes/Database.php` with InfinityFree credentials
4. Upload all files via File Manager or FTP
5. Import `database.sql` via InfinityFree phpMyAdmin
6. Visit your site URL to test

---

*Built for ITEL 203 | Group Performance Task #2 | Secure OOP PHP Web Application with Relational Database*
