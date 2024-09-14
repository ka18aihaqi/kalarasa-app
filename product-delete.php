<?php

$id = isset($_GET['id']) ? $_GET['id'] : null;

if( $id == null ){
    header('HTTP/1.1 403 Forbidden');die();
}

require_once 'config.php';

if( count( checkProduct($id) ) !== 1 ){
    echo "Product not found";
    header('HTTP/1.1 403 Forbidden');die();
}

if( deleteProduct( $id ) ){
    echo "<script>alert('Product data has been successfully deleted'); location.href = 'index.php'</script>";
}else{
    echo "<script>alert('Product data failed to delete'); location.href = 'index.php'</script>";
}
