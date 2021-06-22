<?php
session_start();
require_once('../../db/dbhelper.php');
require_once('../../common/utility.php');
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
                <form action="" method="get">
                    <div class="sidebar-search">
                        <input type="text" name="search" placeholder="Search..." id="search">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </li>
            <li class="sidebar-collapse">
                <span><i class="icon-list fas fa-list-alt"></i>Category <i class="fas fa-angle-left"></i></span> 
                <ul class="sidebar-sublist">
                    <li><a href="../category/index.php">List Category</a></li>
                    <li><a href="../category/add.php">Add Category</a></li>
                </ul>
            </li>
            <li class="sidebar-collapse">
                <span><i class="icon-list fas fa-cube"></i>Product <i class="fas fa-angle-left active"></i></span> 
                <ul class="sidebar-sublist active">
                    <li><a href="../product/">List Product</a></li>
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
                    <div class="content-title">
                        <h1>Products    <small>List</small></h1>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th width="200px">Category Name</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th width="120px">Delete</th>
                                <th width="120px">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
$limit = 10;
$page = 1;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
}
$firstIndex = ($page - 1) * $limit;

$search = '';
if(isset($_GET['search'])) {
    $search = $_GET['search'];
}
$additional = '';

if(!empty($search)) {
    $additional = 'where products.name like "%'.$search.'%"';
}

$sql = 'select categories.name as category_name, products.id, products.name, products.price
from products inner join categories on products.typeId = categories.id '.$additional.' order by products.id limit '.$firstIndex.','.$limit; 
$result = executeResult($sql);
$sql = 'select count(id) as total from products '.$additional.'';
$countResult = executeSingleResult($sql);
$count = $countResult['total'];
$number = ceil($count/$limit);

foreach ($result as $item) {
    echo '<tr align="center">
            <td>'.++$firstIndex.'</td>
            <td>'.$item['category_name'].'</td>
            <td>'.$item['name'].'</td>
            <td>'.number_format($item['price']).'</td>
            <td><a href="add.php?id='.$item['id'].'"><i class="fas fa-pen"></i>Edit</a></td>
            <td><a onclick="deleteProduct('.$item['id'].')"><i class="far fa-trash-alt"></i>Delete</a></td>
        </tr>';
}
?>
                        </tbody>
                    </table>
                <!-- Paginate -->
                <?= pagination($number, $page, '&search='.$search) ?>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/js/main.js"></script>
    <script>
        function deleteProduct(id) {
            var option = confirm('Are you sure to delete this product?');
            if(!option) {
                return;
            }
            $.ajax({
                url: 'ajax.php',
                method: 'post',
                data: {'id': id}
            }).done(function(data) {
                location.reload();  
            });
        }
    </script>
</body>
</html>