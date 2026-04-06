<?php
include 'config.php';
$result = $conn->query("SELECT * FROM students ORDER BY created_at DESC");

// Count students
$total = $conn->query("SELECT COUNT(*) as cnt FROM students")->fetch_assoc()['cnt'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>

<div class="page-wrapper">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">🎓</div>
            <div class="logo-text">
                <span class="logo-title">SIS</span>
                <span class="logo-sub">Student Info System</span>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="index.php" class="nav-item active">
                <span class="nav-icon">📋</span> Students
            </a>
            <a href="create.php" class="nav-item">
                <span class="nav-icon">➕</span> Add Student
            </a>
        </nav>
        <div class="sidebar-stat">
            <div class="stat-number"><?= $total ?></div>
            <div class="stat-label">Total Students</div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <header class="page-header">
            <div>
                <h1 class="page-title">Students</h1>
                <p class="page-subtitle">Manage all enrolled students</p>
            </div>
            <a href="create.php" class="btn-primary">+ Add Student</a>
        </header>

        <!-- Search bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search by name, ID, or course..." oninput="filterTable()">
            <span class="search-icon">🔍</span>
        </div>

        <!-- Table -->
        <div class="table-card">
            <table class="student-table" id="studentTable">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><span class="badge"><?= htmlspecialchars($row['student_id']) ?></span></td>
                            <td class="name-cell"><?= htmlspecialchars($row['last_name']) ?>, <?= htmlspecialchars($row['first_name']) ?></td>
                            <td><?= htmlspecialchars($row['course']) ?></td>
                            <td>
                                <span class="year-pill year-<?= $row['year_level'] ?>">
                                    Year <?= $row['year_level'] ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['contact_number']) ?></td>
                            <td class="actions-cell">
                                <a href="update.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                                <a href="delete.php?id=<?= $row['id'] ?>"
                                   onclick="return confirm('Delete <?= htmlspecialchars($row['first_name']) ?> <?= htmlspecialchars($row['last_name']) ?>?')"
                                   class="btn-delete">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="empty-row">No students found. <a href="create.php">Add your first student</a>.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>
</div>

<script>
function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#studentTable tbody tr');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? '' : 'none';
    });
}
</script>
</body>
</html>
