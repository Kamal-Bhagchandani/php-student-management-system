<?php
require_once __DIR__ . '/includes/auth.php';
requireLogin();
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Student.php';

$studentModel = new Student($conn);
$totalStudents = $studentModel->countStudents();
$recentStudents = $studentModel->getRecentStudents(5);

$pageTitle = 'Dashboard | Student Management System';
require_once __DIR__ . '/includes/header.php';
?>
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h1 class="h2 mb-1">Student Management Dashboard</h1>
        <p class="text-muted mb-0">Welcome, <?= e($_SESSION['admin']['username']); ?>. Manage student records securely.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="/students/add.php" class="btn btn-primary">Add Student</a>
        <a href="/students/list.php" class="btn btn-outline-primary">Manage Students</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card dashboard-card text-bg-primary">
            <div class="card-body">
                <p class="text-uppercase small mb-1">Total Students</p>
                <h2 class="display-5 fw-bold mb-0"><?= e((string) $totalStudents); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card dashboard-card">
            <div class="card-body">
                <h2 class="h5 mb-3">Recent Students</h2>
                <?php if ($recentStudents): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($recentStudents as $student): ?>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" href="/students/view.php?id=<?= e((string) $student['id']); ?>">
                                <span><?= e($student['name']); ?></span>
                                <span class="badge text-bg-light"><?= e($student['course']); ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted mb-0">No students found. Add your first student to get started.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
