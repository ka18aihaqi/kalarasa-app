<x-layout>
    <!-- start-product-content -->
    <section id="product-section">
        <div class="container" id="product-container">
            <div class="text-center">
                <h2 class="text-title">{{ $title }}</h2>
            </div>

            <form action="{{ route('products.page') }}" method="GET">
                <div class="row gy-3 gx-3">
                    <div class="col-12 col-md-6 col-lg-6">
                        <select class="form-select" name="user">
                            <option value="">-- Select barista --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="input-group mb-3">
                            <input name="search" type="text" class="form-control" placeholder="Find the coffee you want" value="{{ $search }}">
                            <button class="btn bg-white btn-outline-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="row justify-content-center text-center">
                @foreach ($products as $product)
                <div class="card border-0" style="width: 18rem;">
                    <a href="{{ route('productdetail.page', $product->slug) }}">
                        <img src="{{ $user->photo ? asset('storage/' . $product->photo) : asset('default-avatar.png') }}" class="img-fluid rounded" alt="Espresso Roast">
                    </a>
                    <div class="card-body ">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 75) }}</p>
                        @if(auth()->check() && (auth()->user()->is_admin || auth()->user()->id == $product->barista_id))
                            <a href="{{ route('product.edit', $product->product_id) }}" class="btn border-0 rounded me-4">Edit</a>
                            <form action="{{ route('product.delete', $product->product_id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn border-0 rounded">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>


            @if(Auth::check())
            <div class="container" id="add-container">
                <div class="title col12 text-center">
                    <h3 class="text-title">Add your product</h3>
                </div>
                <form action="{{ route('products.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-4 justify-content-center">
                        <div class="add-product col-6 d-flex flex-column align-items-center">
                            <div class="col-12 mb-4">
                                <label for="product-title" class="form-label">Product Title</label>
                                <input type="text" class="form-control" id="product-title" placeholder="Fill in the product title" name="title" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="barista-name" class="form-label">Barista's name</label>
                                <select class="form-select" name="barista_id">
                                    <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->name }}</option>
                                    @if(auth()->user()->is_admin) {{-- Gunakan role jika ada --}}
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="product-description" class="form-label">Product description</label>
                                <textarea class="form-control" id="product-description" name="description" placeholder="Fill in the product description"></textarea>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="product_photo" class="form-label">Product Photo</label>
                                <input type="file" name="photo" id="product_photo" class="form-control">
                            </div>
                            <!-- Tombol di bagian bawah dan tengah -->
                            <div class="mt-auto">
                                <button type="submit" class="btn rounded-4">Add product</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
        
        
    </section>
    <!-- end-product-content -->
</x-layout>
