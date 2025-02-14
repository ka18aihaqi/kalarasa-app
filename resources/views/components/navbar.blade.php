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
                            <img src="{{ asset('img/kalaRasaLogo.png') }}" alt="Logo" >
                        </a>
                    </li>
                </ul>
                
                
                <!-- Centered Menu Items -->
                <ul class="navbar-nav flex-grow-1 justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('index') ? 'active' : '' }}" href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="{{ route('products.page') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="{{ route('users.page') }}">Barista</a>
                    </li>
                </ul>
    
            </div>
        </div>
    
        <!-- Contact and Cart on the right -->
        <div class="d-flex ms-auto align-items-center">
    
            @if (Auth::check())
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link">Logout</button>
                </form>            
                <a class="nav-link" href="{{ route('profile.page') }}">
                    <i class="bi bi-person"></i>
                </a>
            @else
                <a class="nav-link me-3" href="{{ route('login.page') }}">Login</a>
                <a class="nav-link me-3" href="{{ route('register.page') }}">Register</a>
            @endif

        </div>
        
    </div>

</nav>
<!-- end-navbar -->