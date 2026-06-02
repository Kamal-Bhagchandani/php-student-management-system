<?php
require_once __DIR__ . '/includes/auth.php';
redirectIfLoggedIn();


$errors = [];
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '') {
        $errors[] = 'Username is required.';
    }

    if ($password === '') {
        $errors[] = 'Password is required.';
    }

    if (!$errors) {
        require_once __DIR__ . '/config/database.php';
        require_once __DIR__ . '/models/Admin.php';

        $adminModel = new Admin($conn);
        $admin = $adminModel->verifyCredentials($username, $password);

        if ($admin) {
            session_regenerate_id(true);
            $_SESSION['admin'] = [
                'id' => $admin['id'],
                'username' => $admin['username'],
            ];
            header('Location: /dashboard.php');
            exit;
        }

        $errors[] = 'Incorrect username or password.';
    }
}

$pageTitle = 'Login | Student Management System';
require_once __DIR__ . '/includes/header.php';
?>
<div class="card auth-card">
    <div class="card-body p-4">
        <h1 class="h3 text-center mb-4">Admin Login</h1>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger"><?= e($error); ?></div>
        <?php endforeach; ?>
        <form method="post" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= e($username); ?>" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="text-muted small mt-3 mb-0">Demo credentials after importing database.sql: admin / admin123</p>
    </div>
</div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
