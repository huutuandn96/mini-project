<?php
require_once ('../../db/dbhelper.php');

if(!empty($_POST)) {
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = 'delete from categories where id='.$id;
        execute($sql);
    }
};