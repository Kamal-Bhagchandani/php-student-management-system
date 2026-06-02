<?php
$host = 'localhost';
$dbname = 'student_management';
$username = 'root';
$password = '';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
$conn = new PDO($dsn, $username, $password, $options);
