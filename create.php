<?php
include 'config.php';

$error = "";

if (isset($_POST['submit'])) {
    $student_id     = $conn->real_escape_string(trim($_POST['student_id']));
    $first_name     = $conn->real_escape_string(trim($_POST['first_name']));
    $last_name      = $conn->real_escape_string(trim($_POST['last_name']));
    $email          = $conn->real_escape_string(trim($_POST['email']));
    $course         = $conn->real_escape_string(trim($_POST['course']));
    $year_level     = intval($_POST['year_level']);
    $contact_number = $conn->real_escape_string(trim($_POST['contact_number']));
    $address        = $conn->real_escape_string(trim($_POST['address']));

    $sql = "INSERT INTO students (student_id, first_name, last_name, email, course, year_level, contact_number, address)
            VALUES ('$student_id','$first_name','$last_name','$email','$course',$year_level,'$contact_number','$address')";

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
    <title>Add Student — SIS</title>
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
            <a href="index.php" class="nav-item">
                <span class="nav-icon">📋</span> Students
            </a>
            <a href="create.php" class="nav-item active">
                <span class="nav-icon">➕</span> Add Student
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <header class="page-header">
            <div>
                <h1 class="page-title">Add New Student</h1>
                <p class="page-subtitle">Fill in the student's information below</p>
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
                        <input type="text" name="student_id" placeholder="e.g. 2024-0001" required>
                    </div>
                </div>

                <div class="form-section-title">Personal Information</div>
                <div class="form-row two-col">
                    <div class="form-group">
                        <label>First Name <span class="required">*</span></label>
                        <input type="text" name="first_name" placeholder="Juan" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name <span class="required">*</span></label>
                        <input type="text" name="last_name" placeholder="Dela Cruz" required>
                    </div>
                </div>
                <div class="form-row two-col">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="juan@email.com">
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" name="contact_number" placeholder="09XXXXXXXXX">
                    </div>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" placeholder="Complete home address" rows="2"></textarea>
                </div>

                <div class="form-section-title">Academic Information</div>
                <div class="form-row two-col">
                    <div class="form-group">
                        <label>Course / Program <span class="required">*</span></label>
                        <input type="text" name="course" placeholder="e.g. BSIT, BSCS, BSE" required>
                    </div>
                    <div class="form-group">
                        <label>Year Level <span class="required">*</span></label>
                        <select name="year_level" required>
                            <option value="">-- Select Year --</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" name="submit" class="btn-primary">Save Student</button>
                    <a href="index.php" class="btn-cancel">Cancel</a>
                </div>

            </form>
        </div>

    </main>
</div>

</body>
</html>
