<?php
include 'config.php';

$id = intval($_GET['id']);
$error = "";

// Fetch existing data
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();

if (!$row) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['update'])) {
    $student_id     = $conn->real_escape_string(trim($_POST['student_id']));
    $first_name     = $conn->real_escape_string(trim($_POST['first_name']));
    $last_name      = $conn->real_escape_string(trim($_POST['last_name']));
    $email          = $conn->real_escape_string(trim($_POST['email']));
    $course         = $conn->real_escape_string(trim($_POST['course']));
    $year_level     = intval($_POST['year_level']);
    $contact_number = $conn->real_escape_string(trim($_POST['contact_number']));
    $address        = $conn->real_escape_string(trim($_POST['address']));

    $sql = "UPDATE students SET
                student_id='$student_id',
                first_name='$first_name',
                last_name='$last_name',
                email='$email',
                course='$course',
                year_level=$year_level,
                contact_number='$contact_number',
                address='$address'
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student — SIS</title>
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
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <header class="page-header">
            <div>
                <h1 class="page-title">Edit Student</h1>
                <p class="page-subtitle">Editing: <?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></p>
            </div>
            <a href="index.php" class="btn-back">← Back to List</a>
        </header>

        <?php if ($error): ?>
            <div class="alert-error"><?= $error ?></div>
        <?php endif; ?>

        <div class="form-card">
            <form method="POST">

                <div class="form-section-title">Identification</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Student ID <span class="required">*</span></label>
                        <input type="text" name="student_id" value="<?= htmlspecialchars($row['student_id']) ?>" required>
                    </div>
                </div>

                <div class="form-section-title">Personal Information</div>
                <div class="form-row two-col">
                    <div class="form-group">
                        <label>First Name <span class="required">*</span></label>
                        <input type="text" name="first_name" value="<?= htmlspecialchars($row['first_name']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name <span class="required">*</span></label>
                        <input type="text" name="last_name" value="<?= htmlspecialchars($row['last_name']) ?>" required>
                    </div>
                </div>
                <div class="form-row two-col">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>">
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" name="contact_number" value="<?= htmlspecialchars($row['contact_number']) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" rows="2"><?= htmlspecialchars($row['address']) ?></textarea>
                </div>

                <div class="form-section-title">Academic Information</div>
                <div class="form-row two-col">
                    <div class="form-group">
                        <label>Course / Program <span class="required">*</span></label>
                        <input type="text" name="course" value="<?= htmlspecialchars($row['course']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Year Level <span class="required">*</span></label>
                        <select name="year_level" required>
                            <option value="">-- Select Year --</option>
                            <?php for ($y = 1; $y <= 4; $y++): ?>
                            <option value="<?= $y ?>" <?= $row['year_level'] == $y ? 'selected' : '' ?>>
                                <?= $y ?>th Year
                            </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" name="update" class="btn-primary">Update Student</button>
                    <a href="index.php" class="btn-cancel">Cancel</a>
                </div>

            </form>
        </div>

    </main>
</div>

</body>
</html>
