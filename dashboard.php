<?php
require 'includes/config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 align="center">Dashboard</h1>
    <h2>Welcome, <?= htmlspecialchars($user['name']) ?>!</h2>
    <p>Email: <?= htmlspecialchars($user['email']) ?></p>
    <p>Phone: <?= htmlspecialchars($user['phone']) ?></p>
    <p>Gender: <?= htmlspecialchars($user['gender']) ?></p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
