<?php
require_once('../db/dbhelper.php');
$passwordErr = $emailErr = '';
if(!empty($_POST)) {
    if(isset($_POST['fullname'])) {
        $fullname = $_POST['fullname'];
    }

    if(isset($_POST['email'])) {
        $sql = 'select email from users';
        $checkEmail = executeResult($sql);
        foreach($checkEmail as $item) {
            if($item['email'] == $_POST['email']) {
                $emailErr = 'This email\'s already exists.';
            } else {
                $email = $_POST['email'];
            }
        }
    }

    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if(isset($_POST['rePassword'])) {
        $rePassword = $_POST['rePassword'];
    }

    if(isset($_POST['phone'])) {
        $phone = $_POST['phone'];
    }

    if($password != $rePassword) {
        $passwordErr = 'Password\'s not matches!';
    } 

    if($passwordErr == '' && $emailErr == '') {
        $sql = 'insert into users (fullname, email, password, phone_number) values
        ("'.$fullname.'", "'.$email.'", "'.$password.'", "'.$phone.'") ';

        execute($sql);
        header('location: login.php');
        die();
    }
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
        <h3 class="admin-text"><a href="../admin/register.php">Admin area</a></h3>
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
            <h2 class="text-center">Register Form</h2>
            <div class="form-group">
                <label>Full name *:</label>
                <input type="text" name="fullname" class="form-control" required placeholder="Enter your fullname" id="fullname">
            </div>
            <div class="form-group">
                <label>Email *:</label>
                <span style="color: red"><?= $emailErr ? $emailErr : '' ?></span>
                <input type="email" name="email" class="form-control" required placeholder="Enter email" id="email">
            </div>
            <div class="form-group">
                <label>Password *:</label>
                <span style="color: red"><?= $passwordErr ? $passwordErr : '' ?></span>
                <input type="password" name="password" class="form-control" required placeholder="Enter password" id="pwd">
            </div>
            <div class="form-group">
                <label>Confirm Password *:</label>
                <input type="password" name="rePassword" class="form-control" required placeholder="Enter confirm password" id="rePwd">
            </div>
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="number" name="phone" class="form-control" placeholder="Enter phone number" id="phone">
            </div>
            <div class="form-btn-box">
                <button type="submit" class="btn form-btn">Register</button>
            </div>
            </form>
    </div>

    <!-- end content -->
    <script src="../assets/js/main.js"></script>
</body>
</html>