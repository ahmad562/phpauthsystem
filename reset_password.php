<?php
require 'includes/config.php';
require 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) === 1) {
        $token = md5(uniqid(mt_rand(), true));
        $query = "UPDATE users SET reset_token = '$token' WHERE email = '$email'";
        mysqli_query($connection, $query);

        echo 'Link to Reset: '. $reset_link = "localhost/phpauthsystem/reset_password_form.php?token=$token";
        sendEmail($email, 'Password Reset', "Click here to reset your password: $reset_link");
        $message = 'Password reset instructions sent to your email.';
    } else {
        $error = 'Email not found.';
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
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Send Reset Link</button>
    </form>
</div>
</body>
</html>
