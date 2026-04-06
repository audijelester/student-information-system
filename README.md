# 🎓 Student Information System

A web-based Student Information System (SIS) built with PHP and MySQL that allows users to manage student records through full CRUD (Create, Read, Update, Delete) operations.

---

## 👥 Members

| Name | Role |
|------|------|
| Audije, Carl Lester | Developer |
| Macalalad, Jhon Ivan | Developer |

---

## 🌐 Deployment Link

🔗 [http://lstr.great-site.net/sis/](http://lstr.great-site.net/sis/)

---

## ✨ Features

- ➕ **Add Student** — Register new students with complete information
- 📋 **View Students** — Display all student records in a table
- ✏️ **Edit Student** — Update existing student information
- ❌ **Delete Student** — Remove student records from the system
- 🔍 **Search** — Filter students by name, ID, or course
- 📊 **Student Counter** — Shows total number of enrolled students

---

## 🛠️ Technologies Used

| Technology | Purpose |
|------------|---------|
| PHP | Server-side scripting |
| MySQL | Database management |
| HTML/CSS | Frontend structure and styling |
| JavaScript | Search/filter functionality |
| InfinityFree | Free web hosting |
| phpMyAdmin | Database administration |

---

## 📁 File Structure

```
sis/
├── config.php        # Database connection
├── index.php         # Student list (READ)
├── create.php        # Add student form (CREATE)
├── update.php        # Edit student form (UPDATE)
├── delete.php        # Delete student handler (DELETE)
├── database.sql      # Database schema
└── assets/
    └── styles.css    # Stylesheet
```

---

## 🗄️ Database

**Database Name:** `if0_41512936_db_sis`

**Table:** `students`

| Column | Type | Description |
|--------|------|-------------|
| id | INT (PK) | Auto-increment primary key |
| student_id | VARCHAR(20) | Unique student ID |
| first_name | VARCHAR(100) | Student's first name |
| last_name | VARCHAR(100) | Student's last name |
| email | VARCHAR(150) | Email address |
| course | VARCHAR(100) | Course/Program enrolled |
| year_level | INT | Current year level (1-4) |
| contact_number | VARCHAR(20) | Contact number |
| address | TEXT | Home address |
| created_at | TIMESTAMP | Date record was created |

---

## 🚀 How to Run Locally

1. Install **XAMPP**
2. Clone this repository into `C:\xampp\htdocs\sis\`
3. Open **phpMyAdmin** at `http://localhost/phpmyadmin`
4. Create a database named `db_students`
5. Import `database.sql`
6. Update `config.php` with your database credentials
7. Open `http://localhost/sis/` in your browser

---

## 📚 PHP & MySQL Concepts Used

- ✅ Database connection using `mysqli`
- ✅ SQL Queries: `INSERT`, `SELECT`, `UPDATE`, `DELETE`
- ✅ Form handling using PHP `$_POST` and `$_GET`
- ✅ Basic input validation and sanitization
- ✅ Modular file structure with `include`
- ✅ Prepared with `real_escape_string` for security

---

*Submitted via Google Classroom — Group PT 2*
