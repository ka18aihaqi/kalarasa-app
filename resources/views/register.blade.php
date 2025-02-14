<x-header></x-header>

<!-- start-content -->
<section id="register-section">
    <div class="container" id="register-container">
        <div class="title col12 text-center">
            <h1 class="text-title">Register</h1>
            <p class="text-desc">"Just a moment with Kala, Feel its charm."</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row gy-4 justify-content-center">
                <div class="add-barista col-6 d-flex flex-column align-items-center">
                    <div class="col-12 mb-4">
                        <label for="baristaname" class="form-label">Barista's name</label>
                        <input type="text" class="form-control" id="baristaname" name="baristaname" placeholder="Fill in the barista's name" >
                        @error('baristaname') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-group col-12 mb-4">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" >
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    
                    <div class="col-12 mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <label for="photo" class="form-label">Photo Profile</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                        @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mt-auto">
                        <button type="submit" class="btn rounded-4">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>