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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentModel->deleteStudent($id);
    flash('success', 'Student deleted successfully.');
    header('Location: /students/list.php');
    exit;
}

$pageTitle = 'Delete Student | Student Management System';
require_once __DIR__ . '/../includes/header.php';
?>
<div class="card dashboard-card">
    <div class="card-body p-4">
        <h1 class="h3 text-danger mb-3">Delete Student</h1>
        <p>Are you sure you want to delete <strong><?= e($student['name']); ?></strong>?</p>
        <form method="post" class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="/students/list.php" class="btn btn-outline-secondary">No, Cancel</a>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
