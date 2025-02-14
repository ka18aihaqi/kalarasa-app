<x-layout>
<section id="home-section">
    <div class="container" id="container-product-edit">
        <div class="title col12 text-center">
            <h1 class="text-title">Edit your product</h1>
            <p class="text-desc">"Just a moment with Kala, Feel its charm."</p>
        </div>

        <form action="{{ route('product.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row gy-4 justify-content-center">
                <div class="edit-product col-6 d-flex flex-column align-items-center">
                    <div class="col-12 mb-4">
                        <label for="product-name" class="form-label">Product name</label>
                        <input type="text" class="form-control" id="product-name" placeholder="Isi judul produk" name="title" value="{{ old('title', $product->title) }}">
                    </div>

                    <div class="col-12 mb-4">
                        <label for="barista-name" class="form-label">Barista's name</label>
                        <select class="form-select" name="barista_id">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $product->barista_id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mb-4">
                        <label for="product-description" class="form-label">Product description</label>
                        <textarea class="form-control" id="product-description" name="description" aria-label="With textarea">{{ old('description', $product->description) }}</textarea>
                    </div>
                    
                    <div class="col-12 mb-4">
                        <label for="product_photo" class="form-label">Product Photo</label>
                        @if($product->product_photo)
                            <img src="{{ asset('storage/' . $product->product_photo) }}" alt="{{ $product->title }}" style="height: 150px" class="d-block mb-3">
                        @endif
                        <input type="file" name="product_photo" id="product_photo" class="form-control">
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="mt-auto">
                        <button type="submit" class="btn rounded-4">Edit produk</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

</x-layout>