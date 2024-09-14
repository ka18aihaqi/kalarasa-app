<?php 
    function setActiveNavbarMenu($requestUrl)
    {
        if( $requestUrl ==  explode('?', $_SERVER["REQUEST_URI"])[0] ){
            echo ' active';
        }
    }
?>

    <!-- start-navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">

    <div class="container">

    <!-- Navbar toggler for small screens -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body align-items-center ">
            <!-- Logo on the left -->
            <ul class="navbar-nav text-center">
                <li class="nav-item">
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/images/kalaRasaLogo.png" alt="Logo" >
                    </a>
                </li>
            </ul>
            
            
            <!-- Centered Menu Items -->
            <ul class="navbar-nav flex-grow-1 justify-content-center">
                <li class="nav-item">
                    <a class="nav-link <?php setActiveNavbarMenu('/kalaRasa-app/index.php#home-section'); ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php setActiveNavbarMenu('/kalaRasa-app/#product-section'); ?>" href="#product-section">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php setActiveNavbarMenu('/kalaRasa-app/barista.php'); ?>" href="#barista-section">Barista</a>
                </li>
            </ul>

        </div>
    </div>

    <!-- Contact and Cart on the right -->
    <div class="d-flex ms-auto align-items-center">
        <a class="nav-link me-3" href="#footer-container">Contact</a>
        <a class="nav-link" href="#cart-container">
            <i class="bi bi-cart"></i>
        </a>
    </div>

</div>

</nav>
<!-- end-navbar -->