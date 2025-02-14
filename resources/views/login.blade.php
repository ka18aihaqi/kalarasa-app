<x-header></x-header>

<section id="login-section">
    <div class="container" id="login-container">
        <div class="title col12 text-center">
            <h1 class="text-title">Login</h1>
            <p class="text-desc">"Just a moment with Kala, Feel its charm."</p>
        </div>

        <!-- Menampilkan error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="row gy-4 justify-content-center">
                <div class="add-barista col-6 d-flex flex-column align-items-center">
                    <div class="input-group col-12 mb-4">
                        <span class="input-group-text"">@</span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>

                    <div class="col-12 mb-4">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="mt-auto">
                        <button type="submit" class="btn rounded-4">Login</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>