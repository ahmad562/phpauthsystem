<?php
require 'includes/config.php';
session_start();

if(isset($_REQUEST['success'])){
    $success = 'New user registred successfully';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE (name = '$username' OR email = '$username') AND password = '$password'";
    $result = mysqli_query($connection,$query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Login</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php elseif (!empty($success)): ?>
        <div class="alert alert-success">
            <?= $success ?>
        </div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label for="username">Username or Email:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Login</button>
        <br>
        If you dont have account please <a href="reset_password.php" >Forgot Password?</a>
    </form>

    <br>
    if you dont have account please <a href="register.php" class="btn btn-info">Register</a>
</div>
</body>
</html>
