<?php

    $koneksi = mysqli_connect('localhost', 'root', '', 'kala-rasa');

    function getAllProducts()
    {
        global $koneksi;
        $query = "SELECT * FROM vw_coffee WHERE title LIKE '%%'";
        if( isset($_GET['search']) ){
            $search = $_GET['search'];
            $query = "SELECT * FROM vw_coffee WHERE title LIKE '%$search%'";
        }

        

        if( isset($_GET['user']) ){
            $user = $_GET['user'];
            if( $user != ""){
                $query .= " AND user_id LIKE '$user'";
            }
        }

        $query .= " ORDER BY id DESC";

        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while( $row = mysqli_fetch_assoc($result) ){
            $rows[] = $row;
        }
        return $rows;
    }

    function getAllUsers()
    {
        global $koneksi;
        $query = "SELECT * FROM users";

        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while( $row = mysqli_fetch_assoc($result) ){
            $rows[] = $row;
        }
        return $rows;
    }

    function getProductsDescription()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            global $koneksi;
            $query = "SELECT * FROM vw_coffee WHERE id=$id";
    
            $result = mysqli_query($koneksi, $query);
            while($row = mysqli_fetch_assoc($result)){
                $rows[] = $row;
            }
        
            return $rows[0];
        }else{
            return null;
        }
    }

    function getUsersDescription()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            global $koneksi;
            $query = "SELECT * FROM users WHERE id=$id";
    
            $result = mysqli_query($koneksi, $query);
            while($row = mysqli_fetch_assoc($result)){
                $rows[] = $row;
            }
        
            return $rows[0];
        }else{
            return null;
        }
    }

    function upload( $image )
    {
        $fileName = $image['name'];
        $tmpName = $image['tmp_name'];
        $fileSize = $image['size'];
        $error = $image['error'];

        if( $error == 4 ){
            echo "<script>
                    alert('The picture must be there');
                </script>";
            return false;
        }

        $imageFormatValid = ['jpg', 'jpeg', 'png', 'webp', 'bmp'];
        $imageFormat = explode('.', $fileName);
        $imageFormat = strtolower(end($imageFormat));

        if( !in_array($imageFormat, $imageFormatValid) ){
            echo "<script>
                    alert('The file must be an image');
                </script>";
            return false;
        }

        if( $fileSize > 2000000 ){
            echo "<script>
                    alert('Maximum image size is 2MB');
                </script>";
            return false;
        }

        $newFileName = date('YmdHis') . uniqid() . '.' . $imageFormat;

        move_uploaded_file($tmpName, 'assets/images/photo-uploaded/' . $newFileName);

        return 'assets/images/photo-uploaded/' . $newFileName;
    }

    function addProduct( $data )
    {
        global $koneksi;

        $title = htmlspecialchars($data['product-name']);
        $user_id = $data['barista-name'];
        $description = $data['product-description'];

        $product_photo = upload($_FILES['product_photo']);

        if ( !$product_photo ){
            return false;
        }
        
        mysqli_query($koneksi, "INSERT INTO products VALUES (NULL, '$title', '$user_id', '$description', '$product_photo',  1)");

        if( mysqli_affected_rows($koneksi) > 0 ){
            return true;
        }else{
            return false;
        }


        
    }

    function addBarista( $data )
    {
        global $koneksi;
        $name = $data['lovyu'];
        $username = $data['username'];
        $password = $data['password'];

        $photo = upload($_FILES['photo']);

        if ( !$photo ){
            return false;
        }
        
        mysqli_query($koneksi, "INSERT INTO users VALUES (NULL, '$name', '$username', '$password', '$photo', 1)");

        if( mysqli_affected_rows($koneksi) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    function checkProduct( $id )
    {
        global $koneksi;
        $query = "SELECT * FROM vw_coffee WHERE id = $id";
        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while( $row = mysqli_fetch_assoc($result) ){
            $rows[] = $row;
        }
        return $rows;
    }

    function checkUser( $id )
    {
        global $koneksi;
        $query = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while( $row = mysqli_fetch_assoc($result) ){
            $rows[] = $row;
        }
        return $rows;
    }

    function deleteProduct( $id )
    {
        global $koneksi;
        $query = "DELETE FROM products WHERE id = $id";
        mysqli_query($koneksi, $query);
        if( mysqli_affected_rows($koneksi) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    function deleteUser( $id )
    {
        global $koneksi;
        $query = "DELETE FROM users WHERE id = $id";
        mysqli_query($koneksi, $query);
        if( mysqli_affected_rows($koneksi) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    function changeProduct( $data )
    {
        global $koneksi;
        $id = $data['id'];
        $title = htmlspecialchars($data['product-name']);
        $user_id = $data['barista-name'];
        $description = $data['product-description'];
        
        mysqli_query($koneksi, "UPDATE products SET title = '$title', user_id = '$user_id', description = '$description' WHERE id = '$id'");

        if( mysqli_affected_rows($koneksi) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    function changeUser( $data )
    {
        global $koneksi;
        $id = $data['id'];
        $name = htmlspecialchars($data['barista-name']);
        $username = $data['barista-username'];
        $password = $data['password'];
        
        mysqli_query($koneksi, "UPDATE users SET name = '$name', username = '$username', password = '$password' WHERE id = '$id'");

        if( mysqli_affected_rows($koneksi) > 0 ){
            return true;
        }else{
            return false;
        }
    }
?>

