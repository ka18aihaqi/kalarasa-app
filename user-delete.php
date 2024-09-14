<?php

$id = isset($_GET['id']) ? $_GET['id'] : null;

if( $id == null ){
    header('HTTP/1.1 403 Forbidden');die();
}

require_once 'config.php';

if( count( checkUser($id) ) !== 1 ){
    echo "Product not found";
    header('HTTP/1.1 403 Forbidden');die();
}

if( deleteUser( $id ) ){
    echo "<script>alert('User data has been successfully deleted'); location.href = 'index.php'</script>";
}else{
    echo "<script>alert('User data failed to delete'); location.href = 'index.php'</script>";
}
