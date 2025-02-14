<x-layout>
    <section id="home-section">
        <div class="container" id="container-user-edit">

            <div class="title col12 text-center">
                <h1 class="text-title">Edit your profile</h1>
                <p class="text-desc">"Just a moment with Kala, Feel its charm."</p>
            </div>

            <form action="{{ route('user.edit', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="row gy-4 justify-content-center">
                    <div class="edit-barista col-6 d-flex flex-column align-items-center">
                        <!-- Display user photo -->
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" style="height: 150px" class="d-block mb-3">

                        <!-- Input: Name -->
                        <div class="col-12 mb-4">
                            <label for="baristaname" class="form-label">Barista's name</label>
                            <input type="text" class="form-control" id="baristaname" name="baristaname" value="{{ $user->name }}" required>
                        </div>

                        <div class="col-12 mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" 
                                {{ auth()->user()->is_admin ? '' : 'readonly' }}>
                        </div>
                        
                        <div class="input-group col-12 mb-4">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" 
                                {{ auth()->user()->is_admin ? '' : 'readonly' }}>
                        </div>                        

                        <div class="col-12 mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru jika ingin mengganti">
                        </div>  

                        <div class="col-12 mb-4">
                            <label for="photo" class="form-label">Photo Profile</label>
                            <input type="file" name="photo" id="photo" class="form-control">
                        </div>
            
                        <div class="mt-auto">
                            <button type="submit" class="btn rounded-4">Edit Profile</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if ($errors->has('username') || $errors->has('email'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Input!',
                    html: `
                        @if ($errors->has('username'))
                            <p>{{ $errors->first('username') }}</p>
                        @endif
                        @if ($errors->has('email'))
                            <p>{{ $errors->first('email') }}</p>
                        @endif
                    `,
                    confirmButtonText: 'OK'
                });
            </script>
        @endif

    </section>
</x-layout>
