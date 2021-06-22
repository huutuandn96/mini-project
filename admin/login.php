<?php
session_start();
require_once('../db/dbhelper.php');
$loginErr = '';
if(!empty($_POST)) {
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if(isset($_POST['remember_check'])) {
        $remember_check = $_POST['remember_check'];
    }
    if(!empty($email) && !empty($password)) {
        $sql = 'select * from users where email="'.$email.'" and password="'.$password.'"';
        $loginCheck = executeSingleResult($sql);
        if($loginCheck != null) {
            if($loginCheck['role'] == 1) {
                if($remember_check == 1) {
                    setcookie('email', $email, time()+ 24*60*60, "/");
                    setcookie('password', $password, time()+ 24*60*60, "/");
                }
                $_SESSION['login'] = $loginCheck;
                header('location: http://localhost/apps/miniproject/admin/'); 
                die();
            } else {
                $loginErr = 'Your account is not admin!';
            }
        } else {
            $loginErr = 'Email or password is incorrect!';
        }
    }
}
$check = false;
if(isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];
    $check = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- nav -->
    <nav class="navbar navbar-expand-sm">
        <h3 class="admin-text"><a href="../admin/login.php">Admin area</a></h3>
        <ul class="navbar-right">
            <li><a href="./register.php">Sign Up<i class="fas fa-user-plus"></i></a></li>
            <li><a href="./login.php">Sign In<i class="fas fa-sign-in-alt"></i></a></li>
        </ul>
        <ul class="navbar-right nav-r-mobile">
            <li><a title="Sign up" href="./register.php"><i class="fas fa-user-plus"></i></a></li>
            <li><a title="Sign in" href="./login.php"><i class="fas fa-sign-in-alt"></i></a></li>
        </ul>
        <button type="button" class="mobile-list-btn"><i class="fas fa-list-ul"></i></button>
    </nav>
    <!-- end nav -->
    <!-- Content -->
    <div class="form-contain">
        <form action="<?php $_PHP_SELF ?>" method="post">
            <h2 class="text-center">Login Form</h2>
            <div class="form-group">
                <label>Email:</label>
                <span style="color:red"><?= $loginErr ? $loginErr : '' ?></span>
                <input type="email" name="email" value="<?= $email ? $email : '' ?>" class="form-control" required placeholder="Enter email" id="email">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" value="<?= $password ? $password : '' ?>" class="form-control" required placeholder="Enter password" id="pwd">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" <?= $check ? 'checked' : '' ?> name="remember_check" value="1" class="form-check-input">
                <label class="form-check-label">Remember me.</label>
              </div>
            <div class="form-btn-box">
                <button type="submit" class="btn form-btn">Login</button>
            </div>
            <p class="text-center"><a href="./register.php">Do you have an account? Register here!</a></p>
            </form>
    </div>

    <!-- end content -->
    <script src="../assets/js/main.js"></script>
</body>
</html>