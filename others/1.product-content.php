<!-- start-product-content -->
<section id="product-section">

    <div class="container" id="product-container">
        <div class="text-center">
            <h2 class="text-title">Our Products!</h2>
        </div>
        <div class="row gy-4">
            <form action="index.php" method="GET">
                <div class="row gy-3 gx-3">
                    <div class="col-12 col-md-6 col-lg-6">
                        <select class="form-select" name="user">
                            <option value="">-- Select barista --</option>
                            <?php foreach($users as $user) : ?>
                                <option value="<?= $user['id'] ?>" <?php if($user['id'] == $userID): echo ' selected'; endif;?>><?= $user['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="input-group mb-3">
                            <input name="search" type="text" class="form-control" placeholder="Find the coffee you want" value="<?= $search ?>">
                            <button class="btn bg-white btn-outline-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row justify-content-center text-center">
                <?php foreach($products as $product): ?>
                    <div class="card border-0" style="width: 18rem;">
                        <a href="product-detail.php?id=<?= $product['id'] ?>">
                            <img src="<?= $product['product_photo']?>" class="img-fluid rounded" alt="Espresso Roast">
                        </a>
                        <div class="card-body ">
                            <h5 class="card-title"><?= $product['title'] ?></h5>
                            <p class="card-text"><?= $product['description'] ?></p>
                            <a href="product-edit.php?id=<?= $product['id'] ?>" class="btn border-0 rounded me-4">Edit</a>
                            <a href="product-delete.php?id=<?= $product['id'] ?>" class="btn border-0 rounded">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="container" id="add-container">
        <div class="title col12 text-center">
            <h3 class="text-title">Add your product</h3>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row gy-4 justify-content-center">
                <div class="add-product col-6 d-flex flex-column align-items-center">
                    <div class="col-12 mb-4">
                        <label for="product-name" class="form-label">Product name</label>
                        <input type="text" class="form-control" id="product-name" placeholder="Fill in the product name" name="product-name">
                    </div>
                    <div class="col-12 mb-4">
                        <label for="barista-name" class="form-label">Barista's name</label>
                        <select class="form-select"  name="barista-name">
                            <option value="" disabled selected>-- Select barista --</option>
                            <?php foreach($users as $user) : ?>
                                <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 mb-4">
                        <label for="product-description" class="form-label">Product description</label>
                        <textarea class="form-control" id="product-description" name="product-description" placeholder="Fill in the product description"></textarea>
                    </div>
                    <div class="col-12 mb-4">
                        <label for="product_photo" class="form-label">Product Photo</label>
                        <input type="file" name="product_photo" id="product_photo" class="form-control">
                    </div>
                    <!-- Tombol di bagian bawah dan tengah -->
                    <div class="mt-auto">
                        <button type="submit" class="btn rounded-4" name="submit-produk">Add product</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</section>
<!-- end-product-content -->