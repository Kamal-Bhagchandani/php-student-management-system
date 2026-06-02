<?php
require_once __DIR__ . '/auth.php';
$pageTitle = $pageTitle ?? 'Student Management System';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="/dashboard.php">Student Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php if (isLoggedIn()): ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/students/list.php">Students</a></li>
                    <li class="nav-item"><a class="nav-link" href="/students/add.php">Add Student</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout.php">Logout</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>
<main class="container py-4">
    <?php foreach (getFlashMessages() as $flash): ?>
        <div class="alert alert-<?= e($flash['type']); ?> alert-dismissible fade show" role="alert">
            <?= e($flash['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
