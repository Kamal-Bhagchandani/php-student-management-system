<?php
require_once __DIR__ . '/../includes/auth.php';
requireLogin();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Student.php';

$studentModel = new Student($conn);
$search = trim($_GET['search'] ?? '');
$students = $studentModel->getStudents($search ?: null);

$pageTitle = 'Students | Student Management System';
require_once __DIR__ . '/../includes/header.php';
?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <h1 class="h3 mb-0">Manage Students</h1>
    <a href="/students/add.php" class="btn btn-primary">Add Student</a>
</div>
<form class="card dashboard-card mb-4" method="get">
    <div class="card-body">
        <label for="search" class="form-label">Search by Name, Email, or Student ID</label>
        <div class="input-group">
            <input type="search" class="form-control" id="search" name="search" value="<?= e($search); ?>" placeholder="Search students">
            <button class="btn btn-outline-primary" type="submit">Search</button>
            <?php if ($search !== ''): ?>
                <a class="btn btn-outline-secondary" href="/students/list.php">Clear</a>
            <?php endif; ?>
        </div>
    </div>
</form>
<div class="card dashboard-card">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= e($student['student_id']); ?></td>
                        <td><?= e($student['name']); ?></td>
                        <td><?= e($student['email']); ?></td>
                        <td><?= e($student['course']); ?></td>
                        <td class="table-actions">
                            <a class="btn btn-sm btn-outline-info" href="/students/view.php?id=<?= e((string) $student['id']); ?>">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="/students/edit.php?id=<?= e((string) $student['id']); ?>">Edit</a>
                            <a class="btn btn-sm btn-outline-danger" href="/students/delete.php?id=<?= e((string) $student['id']); ?>" data-confirm="Are you sure you want to delete this student?">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$students): ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">No students found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
