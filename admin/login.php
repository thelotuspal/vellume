<?php
session_start();
require '../config/db.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded admin for simplicity (you can later use DB)
    if($username == "admin" && $password == "admin123"){
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 400px;">
    <h3 class="text-center mb-4">Admin Login</h3>
    <?php if(isset($error)){ echo '<div class="alert alert-danger">'.$error.'</div>'; } ?>
    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>
