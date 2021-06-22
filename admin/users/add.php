<?php
session_start();
unset($_SESSION['success']);
require_once ('../../db/dbhelper.php');
$password = $passwordErr = $emailErr = '';
if(!empty($_POST)) {
    if(isset($_POST['fullname'])) {
        $fullname = $_POST['fullname'];
    }

    if(isset($_POST['email'])) {
        if(isset($_GET['id'])) {
            $idGet = $_GET['id'];
            $sql = 'select email from users where id='.$idGet;
            $checkSame = executeSingleResult($sql);
            $originEmail = $checkSame['email'];
            if($originEmail != '') {
                $sql = 'select email from users where email not like  "'.$originEmail.'"';
                $checkEmail = executeResult($sql);
                if($checkEmail != null) {
                    foreach ($checkEmail as $item) {
                        if($item['email'] == $_POST['email']) {
                            $emailErr = 'This email\'s already exist.';
                        } else {
                            $email = $_POST['email'];
                        }
                    }
                 }
            }
        } else {
            $sql = 'select email from users';
            $checkEmail = executeResult($sql);
            if($checkEmail != null) {
                foreach ($checkEmail as $item) {
                    if($item['email'] == $_POST['email']) {
                        $emailErr = 'This email\'s already exist.';
                    } else {
                        $email = $_POST['email'];
                    }
                }
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

    if(isset($_POST['role'])) {
        $role = $_POST['role'];
    }

    if(isset($_POST['id'])) {
        $id  = $_POST['id'];
    }

    if($password != $rePassword) {
        $passwordErr = "Password's not matches!"; 
    } 
    if($passwordErr == '' && $emailErr == '') {
        if($id == '') {
            $sql = 'insert into users(fullname, email, password, phone_number, role) values ("'.$fullname.'", "'.$email.'", "'.$password.'", "'.$phone.'", "'.$role.'")';
            $_SESSION['success'] = 'The new user was added successfully!';
        } else {
            if($password == '') {
                $sql = 'update users set fullname = "'.$fullname.'", email = "'.$email.'", phone_number = "'.$phone.'", role = "'.$role.'" where id='.$id;
                $_SESSION['success'] = 'The user was edited successfully!';

            } else {
                $sql = 'update users set fullname = "'.$fullname.'", email = "'.$email.'", password = "'.$password.'", phone_number = "'.$phone.'", role = "'.$role.'" where id='.$id;
                $_SESSION['success'] = 'The user was edited successfully!';
            }
        }
        execute($sql);
    }        
}

if(!empty($_GET)) {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $sql = 'select * from users where id='.$id;
    $result = executeSingleResult($sql);
    if($result != null) {
        $fullname = $result['fullname'];
        $email = $result['email'];
        $phone = $result['phone_number'];
        $role = $result['role'];
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
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar navbar-expand-sm">
        <h3 class="admin-text"><a href="../category">Admin area</a></h3>
        <ul class="navbar-right">
<?php
if(isset($_SESSION['login'])) {
    $username = $_SESSION['login']['fullname'];
    $userId = $_SESSION['login']['id'];
    echo ' <li class="user-task">
                <div class="nav-user">
                    <i class="far fa-user"></i>
                    <span>'.$username.'</span>
                    <i class="fas fa-caret-down"></i>
                    <ul class="nav-user-sub">
                        <li><a href="../users/add.php?id='.$userId.'"><i class="fas fa-file-alt"></i>User info</a></li>
                        <li><a href="../logout.php""><i class="fas fa-sign-out-alt"></i>Sign out</a></li>
                    </ul>
                </div>
            </li>';
} else {
    echo '<li><a href="../register.php">Sign Up<i class="fas fa-user-plus"></i></a></li>
        <li><a href="../logout.php">Sign In<i class="fas fa-sign-in-alt"></i></a></li>';
}
?>
        </ul>
        <ul class="navbar-right nav-r-mobile">
<?php
if(isset($_SESSION['login'])) {
    $username = $_SESSION['login']['fullname'];
    $userId = $_SESSION['login']['id'];
    echo ' <li class="user-task">
                <div class="nav-user">
                    <i class="far fa-user"></i>
                    <span>'.$username.'</span>
                    <i class="fas fa-caret-down"></i>
                    <ul class="nav-user-sub">
                        <li><a href="../users/add.php?id='.$userId.'"><i class="fas fa-file-alt"></i>User info</a></li>
                        <li><a href="../logout.php""><i class="fas fa-sign-out-alt"></i>Sign out</a></li>
                    </ul>
                </div>
            </li>';
} else {
    echo '<li><a title="Sign up" href="../register.php"><i class="fas fa-user-plus"></i></a></li>
    <li><a title="Sign in" href="../logout.php"><i class="fas fa-sign-in-alt"></i></a></li>';
}
?>
        </ul>
        <button type="button" class="mobile-list-btn"><i class="fas fa-list-ul"></i></button>
    </nav>
    <div class="sidebar">
        <ul class="sidebar-list">
            <li>
                <div class="sidebar-search">
                    <input type="text" placeholder="Search...">
                    <button class="btn" type="button"><i class="fas fa-search"></i></button>
                </div>
            </li>
            <li class="sidebar-collapse">
                <span><i class="icon-list fas fa-list-alt"></i>Category <i class="fas fa-angle-left "></i></span> 
                <ul class="sidebar-sublist ">
                    <li><a href="../category/index.php">List Category</a></li>
                    <li><a href="../category/add.php">Add Category</a></li>
                </ul>
            </li>
            <li class="sidebar-collapse">
                <span><i class="icon-list fas fa-cube"></i>Product <i class="fas fa-angle-left"></i></span> 
                <ul class="sidebar-sublist">
                    <li><a href="../product/index.php">List Product</a></li>
                    <li><a href="../product/add.php">Add Product</a></li>
                </ul>
            </li>
            <li class="sidebar-collapse">
                <span><i class="icon-list fas fa-users"></i>User <i class="fas fa-angle-left active"></i></span> 
                <ul class="sidebar-sublist active">
                    <li><a href="./index.php">List User</a></li>
                    <li><a href="./add.php">Add User</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="content-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
<?php
if(isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    echo ' <div class="alert alert-success">'.$message.'</div>';
}
?>               
                    <div class="content-title">
                        <h1>Users <small>Add</small></h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-7">
                            <form action=" <?php $_PHP_SELF ?>" method="post">
                                <div class="form-group">
                                  <label>Fullname: *</label>
                                  <input type="text" name="id" value="<?= $id ?>" hidden = "true">
                                  <input type="text" name="fullname" value="<?= $fullname ?>" class="form-control" placeholder="Enter fullname" required id="fullname">
                                </div>
                                <div class="form-group">
                                  <label>Email: *</label>
                                  <span style="color:red"><?= $emailErr ? $emailErr : '' ?></span>
                                  <input type="email" name="email" value="<?= $email ?>" class="form-control" placeholder="Enter the email" required id="email">
                                </div>
                                <div class="form-group">
<?php 
$id ? print('<input type="checkbox" class="change-password">') : ''
?>                                  
                                  <label><?= $id? 'Change ' : ''?>Password: *</label>
                                  <span style="color:red"> <?= $passwordErr ?></span> 
                                  <input type="password" name="password"  <?= $id ? 'disabled' : '' ?> class="form-control changePassword" placeholder="Enter password" required id="pwd">
                                </div>
                                <div class="form-group">
                                  <label>Confirm password: *</label>
                                  <input type="password" name="rePassword" <?= $id ? 'disabled' : '' ?> class="form-control changePassword" placeholder="Enter confirm password" required id="rePwd">
                                </div>
                                <div class="form-group">
                                  <label>Phone number:</label>
                                  <input type="number" name="phone" value="<?= $phone ?>" class="form-control" placeholder="Enter product's name" id="phone">
                                </div>
                                <label for="">Role:</label> <br>
                                <input <?= $role == 1 ? 'checked' : '' ?> type="radio" name="role" value="1" required> <label for="">Admin</label>
                                <input <?= $role == 0 ? 'checked' : '' ?> type="radio" name="role" value="0" required> <label for="">User</label>
                                <br>
                                <button type="submit" class="btn btn-default">Save</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('.change-password').change(function() {
                if($(this).is(':checked')) {
                    $('.changePassword').removeAttr('disabled');
                } else {
                    $('.changePassword').attr('disabled', '');
                }
                
            });
        });
    </script>
</body>
</html>