<?php
require_once __DIR__ . '/../includes/auth.php';
requireLogin();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Student.php';

$studentModel = new Student($conn);
$student = [
    'student_id' => '',
    'name' => '',
    'email' => '',
    'phone' => '',
    'course' => '',
    'year' => '',
    'address' => '',
];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student = array_map('trim', [
        'student_id' => $_POST['student_id'] ?? '',
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'course' => $_POST['course'] ?? '',
        'year' => $_POST['year'] ?? '',
        'address' => $_POST['address'] ?? '',
    ]);

    foreach (['student_id', 'name', 'email', 'phone', 'course', 'year', 'address'] as $field) {
        if ($student[$field] === '') {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }

    if ($student['email'] !== '' && !filter_var($student['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($student['phone'] !== '' && !preg_match('/^[0-9+\-\s]{10,15}$/', $student['phone'])) {
        $errors[] = 'Phone number must be 10 to 15 characters and contain only numbers, spaces, +, or -.';
    }

    if ($student['student_id'] !== '' && $studentModel->studentIdExists($student['student_id'])) {
        $errors[] = 'Student ID already exists.';
    }

    if (!$errors) {
        $studentModel->addStudent($student);
        flash('success', 'Student added successfully.');
        header('Location: /students/list.php');
        exit;
    }
}

$pageTitle = 'Add Student | Student Management System';
require_once __DIR__ . '/../includes/header.php';
?>
<div class="card dashboard-card">
    <div class="card-body p-4">
        <h1 class="h3 mb-4">Add Student</h1>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger"><?= e($error); ?></div>
        <?php endforeach; ?>
        <form method="post" novalidate>
            <?php require __DIR__ . '/_form.php'; ?>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Student</button>
                <a href="/students/list.php" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
