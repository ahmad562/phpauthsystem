<?php
require 'includes/config.php';

if (!isset($_GET['token'])) {
    die('Invalid or missing token.');
}

$token = $_GET['token'];

$query = "SELECT * FROM users WHERE reset_token = '$token'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) !== 1) {
    die('Invalid or expired token.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        $hashed_password = md5($new_password);
        $query = "UPDATE users SET password = '$hashed_password', reset_token = NULL WHERE reset_token = '$token'";
        mysqli_query($connection, $query);

        if (mysqli_affected_rows($connection) > 0) {
            $message = 'Your password has been successfully reset.';
        } else {
            $error = 'An error occurred. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Reset Password</h2>
    <?php if (!empty($message)): ?>
        <div class="alert alert-success">
            <?= $message ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
</body>
</html>
