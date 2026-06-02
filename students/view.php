<?php
require_once __DIR__ . '/../includes/auth.php';
requireLogin();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Student.php';

$studentModel = new Student($conn);
$id = (int) ($_GET['id'] ?? 0);
$student = $studentModel->getStudentById($id);

if (!$student) {
    flash('danger', 'Student not found.');
    header('Location: /students/list.php');
    exit;
}

$pageTitle = 'View Student | Student Management System';
require_once __DIR__ . '/../includes/header.php';
?>
<div class="card dashboard-card">
    <div class="card-body p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
            <h1 class="h3 mb-0"><?= e($student['name']); ?></h1>
            <div>
                <a class="btn btn-outline-primary" href="/students/edit.php?id=<?= e((string) $student['id']); ?>">Edit</a>
                <a class="btn btn-outline-secondary" href="/students/list.php">Back</a>
            </div>
        </div>
        <dl class="row mb-0">
            <dt class="col-sm-3">Student ID</dt><dd class="col-sm-9"><?= e($student['student_id']); ?></dd>
            <dt class="col-sm-3">Email</dt><dd class="col-sm-9"><?= e($student['email']); ?></dd>
            <dt class="col-sm-3">Phone</dt><dd class="col-sm-9"><?= e($student['phone']); ?></dd>
            <dt class="col-sm-3">Course</dt><dd class="col-sm-9"><?= e($student['course']); ?></dd>
            <dt class="col-sm-3">Year</dt><dd class="col-sm-9"><?= e((string) $student['year']); ?></dd>
            <dt class="col-sm-3">Address</dt><dd class="col-sm-9"><?= nl2br(e($student['address'])); ?></dd>
            <dt class="col-sm-3">Created At</dt><dd class="col-sm-9"><?= e($student['created_at']); ?></dd>
        </dl>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
