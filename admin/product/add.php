<?php
session_start();
unset($_SESSION['success']);
require_once ('../../db/dbhelper.php');

if(!empty($_POST)) {
    if(isset($_POST['categoryId'])) {
        $categoryId = $_POST['categoryId'];
    }

    if(isset($_POST['product_name'])) {
        $product_name = $_POST['product_name'];
    }

    if(isset($_POST['product_price'])) {
        $product_price = $_POST['product_price'];
    }

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    if($id == '') {
        $sql = 'insert into products(name, price, typeId) values ("'.$product_name.'", "'.$product_price.'", "'.$categoryId.'")';
        $_SESSION['success'] = 'The new product was added successfully!';

    } else {
        $sql = 'update products set name="'.$product_name.'", price = "'.$product_price.'", typeId = "'.$categoryId.'" where id='.$id;
        $_SESSION['success'] = 'The product was edited successfully!';

    }

    execute($sql);
}

if(!empty($_GET)) {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $sql = 'select * from products where id='.$id;
    $product = executeSingleResult($sql);
    if($product != null) {
        $name = $product['name'];
        $price = $product['price'];
        $categoryId = $product['typeId'];
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
                <span><i class="icon-list fas fa-cube"></i>Product <i class="fas fa-angle-left active"></i></span> 
                <ul class="sidebar-sublist active">
                    <li><a href="./index.php">List Product</a></li>
                    <li><a href="./add.php">Add Product</a></li>
                </ul>
            </li>
            <li class="sidebar-collapse">
                <span><i class="icon-list fas fa-users"></i>User <i class="fas fa-angle-left"></i></span> 
                <ul class="sidebar-sublist">
                    <li><a href="../users/index.php">List User</a></li>
                    <li><a href="../users/add.php">Add User</a></li>
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
                        <h1>Products <small>Add</small></h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-7">
                            <form action="<?php $_PHP_SELF ?>" method="post">
                                <div class="form-group">
                                  <label>Category Name</label>
                                  <input type="text" name="id" value="<?= $id ?>" hidden="true"> 
                                  <select name="categoryId" class="form-control">
                                    <option value="">--Choose the category</option>
<?php
$sql = 'select * from categories';
$result = executeResult($sql);
foreach ($result as $item) {
    if($item['id'] == $categoryId) {
        echo '<option selected value="'.$item['id'].'">'.$item['name'].'</option>';
    } else {
        echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
    }
}
?>
                                  </select> 
                                </div>
                                <div class="form-group">
                                  <label>Product name:</label>
                                  <input type="text" name="product_name" value="<?= $name ?>" class="form-control" placeholder="Enter product's name" required id="pwd">
                                </div>
                                <div class="form-group">
                                    <label>Price:</label>
                                    <input type="number" name="product_price" value="<?= $price ?>" class="form-control" placeholder="Enter product's price" required id="pwd">
                                </div>
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
</body>
</html>