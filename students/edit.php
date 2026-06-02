<?php
require_once __DIR__ . '/../includes/auth.php';
requireLogin();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Student.php';

$studentModel = new Student($conn);
$id = (int) ($_GET['id'] ?? 0);
$student = $studentModel->getStudentById($id);
$errors = [];
$isEdit = true;

if (!$student) {
    flash('danger', 'Student not found.');
    header('Location: /students/list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student = array_merge($student, array_map('trim', [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'course' => $_POST['course'] ?? '',
        'year' => $_POST['year'] ?? '',
        'address' => $_POST['address'] ?? '',
    ]));

    foreach (['name', 'email', 'phone', 'course', 'year', 'address'] as $field) {
        if ($student[$field] === '') {
            $errors[] = ucfirst($field) . ' is required.';
        }
    }

    if ($student['email'] !== '' && !filter_var($student['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($student['phone'] !== '' && !preg_match('/^[0-9+\-\s]{10,15}$/', $student['phone'])) {
        $errors[] = 'Phone number must be 10 to 15 characters and contain only numbers, spaces, +, or -.';
    }

    if (!$errors) {
        $studentModel->updateStudent($id, $student);
        flash('success', 'Student updated successfully.');
        header('Location: /students/view.php?id=' . $id);
        exit;
    }
}

$pageTitle = 'Edit Student | Student Management System';
require_once __DIR__ . '/../includes/header.php';
?>
<div class="card dashboard-card">
    <div class="card-body p-4">
        <h1 class="h3 mb-4">Edit Student</h1>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger"><?= e($error); ?></div>
        <?php endforeach; ?>
        <form method="post" novalidate>
            <?php require __DIR__ . '/_form.php'; ?>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="/students/view.php?id=<?= e((string) $id); ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
