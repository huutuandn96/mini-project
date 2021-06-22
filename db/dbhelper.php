<?php
require_once('config.php');

function execute($sql) {
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    mysqli_set_charset($conn, 'utf8');

    if($conn->connect_error) {
        var_dump($conn->connect_error);
        die();
    } 

    mysqli_query($conn, $sql);

    mysqli_close($conn);
}

function executeResult($sql) {
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    mysqli_set_charset($conn, 'utf8');

    if($conn->connect_error) {
        var_dump($conn->connect_error);
        die();
    } 

    $data = [];
    $result =   mysqli_query($conn, $sql);
    if($result != null) {
        while($row = mysqli_fetch_array($result, 1)) {
            $data[] = $row;
        }
    }

    mysqli_close($conn);

    return $data;
}

function executeSingleResult($sql) {
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    mysqli_set_charset($conn, 'utf8');

    if($conn->connect_error) {
        var_dump($conn->connect_error);
        die();
    } 

    $result =   mysqli_query($conn, $sql);
    if($result != null) {
       $data = mysqli_fetch_array($result, 1);
    }

    mysqli_close($conn);

    return $data;
}

