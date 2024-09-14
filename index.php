<?php
    require_once 'config.php';

    $products = getAllProducts();
    $users = getAllUsers();

    $search = isset($_GET['search']) ? $_GET['search'] : null;
    $userID = isset($_GET['user']) ? $_GET['user'] : null;

    if( isset($_POST['submit-produk']) ){
        if( addProduct($_POST) ){
            echo "<script>
                    alert('New product data has been successfully created');
                    location.href = 'index.php';
                </script>";
        }else{
            echo "<script>
                    alert('New product data failed to create');
                    location.href = 'index.php';
                </script>";
        }
    }

    if( isset($_POST['submit-barista']) ){
        if( addBarista($_POST) ){
            echo "<script>
                    alert('New barista data has been successfully created');
                    location.href = 'index.php';
                </script>";
        }else{
            echo "<script>
                    alert('New barista data failed to create');
                    location.href = 'index.php';
                </script>";
        }
    }
    
    include_once 'templates/header.php';
    include_once 'templates/navbar.php';
?>

<!-- start-content -->
<section id="home-section">
    <div class="container" id="home-container">
        <div class="title col12 text-center">
            <h1 class="text-title">Kala Rasa</h1>
            <p class="text-desc">"Just a moment with Kala, Feel its charm."</p>
        </div>
    </div>
</section>
<!-- end-content -->


<?php include_once 'others/1.product-content.php'; ?>

<section id="slides-1">
    <div class="container-fluid text-center">
        Find your style
    </div>
</section>  

<?php include_once 'others/2.barista-content.php'; ?>

<?php include_once 'templates/footer.php'; ?>