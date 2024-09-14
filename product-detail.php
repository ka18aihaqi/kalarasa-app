<?php
    require_once 'config.php';
    $products = getProductsDescription();
    include_once 'templates/header.php';
    include_once 'templates/navbar.php';
?>
<!-- start-content -->
<section id="home-section">
    <div class="container" id="container-detail">
        <div class="row gy-4">
            <div class="products col-10 col-md-8 col-lg-6">
                <img src="assets/images/espressoRoast.png" alt="Espresso Roast" class="img-fluid">
            </div>
            <div class="products col-10 col-md-8 col-lg-6 align-self-center">
                
                <h5 class="card-title"><?= $products['title'] ?></h5>
                <p class="card-name">By <?= $products['user_name'] ?></p>
                <p class="card-price">$200</p>
                <p class="card-text"><?= $products['description'] ?></p>

                <a href="product-edit.php?id=<?= $products['id'] ?>" class="btn rounded-4 me-4">Edit</a>
                <a href="product-delete.php?id=<?= $products['id'] ?>" class="btn rounded-4">Delete</a>
            </div>
        </div>
    </div>
</section>
<!-- end-content -->

<?php include_once 'templates/footer.php'; ?>