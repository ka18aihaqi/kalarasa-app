<?php
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if( $id == null ){
        header('HTTP/1.1 403 Forbidden');die();
    }

    require_once 'config.php';

    if( count( checkProduct($id) ) !== 1 ){
        echo "Produk tidak ditemukan";
        header('HTTP/1.1 403 Forbidden');die();
    }

    if( isset($_POST['submit']) ){
        if( changeProduct($_POST) ){
            echo "<script>
                    alert('Product data has been successfully changed');
                    location.href = 'index.php';
                </script>";
        }else{
            echo "<script>
                    alert('Product data failed to change');
                    location.href = 'index.php';
                </script>";
        }
    }

    $users = getAllUsers();
    $product = getProductsDescription();
    include_once 'templates/header.php';
    include_once 'templates/navbar.php';
?>

<!-- start-content -->
<section id="home-section">
    <div class="container" id="container-product-edit">

            <div class="title col12 text-center">
                <h1 class="text-title">Edit your product</h1>
                <p class="text-desc">"Just a moment with Kala, Feel its charm."</p>
            </div>

            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $product['id'] ?>">

                <div class="row gy-4 justify-content-center">
                    <div class="edit-product col-6 d-flex flex-column align-items-center">
                        <div class="col-12 mb-4">
                            <label for="product-name" class="form-label">Product name</label>
                            <input type="text" class="form-control" id="product-name" placeholder="Isi judul produk" name="product-name" value="<?= $product['title'] ?>">
                        </div>

                        <div class="col-12 mb-4">
                            <label for="barista-name" class="form-label">Barista's name</label>
                            <select class="form-select" name="barista-name">
                                <?php foreach($users as $user) : ?>
                                    <option value="<?= $user['id'] ?>"<?php if( $user['id'] == $product['user_id'] ): echo 'selected'; else: echo ''; endif;?>><?= $user['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12 mb-4">
                            <label for="pruduct-description" class="form-label">Product description</label>
                            <textarea class="form-control" id="description" name="pruduct-description" aria-label="With textarea"><?= $product['description'] ?></textarea>
                        </div>

                        <!-- Tombol di bagian bawah dan tengah -->
                        <div class="mt-auto">
                            <button type="submit" class="btn rounded-4" name="submit">Edit produk</button>
                        </div>
                    </div>
                </div>

            </form>
    </div>
</section>
<!-- end-content -->

<?php include_once 'templates/footer.php'; ?>