<x-layout>
    <!-- start-product-content -->
    <section id="home-section">
        <div class="container" id="container-detail">
            <div class="row gy-4">
                <div class="products col-10 col-md-8 col-lg-6">
                    <img src="/" alt=..." class="img-fluid">
                </div>
                <div class="products col-10 col-md-8 col-lg-6 align-self-center">
                    
                    <h5 class="card-title">{{ $product->title }}</h5>
                    <a href="{{ route('products.by.user', $product->barista->id) }}" class="card-name">By {{ $product->barista->name }}</a>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">{{ $product->created_at->diffForHumans() }}</p>
                    
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
            <a href="/products" class="btn rounded-4">&laquo; Back</a>
        </div>
    </section>
    <!-- end-product-content -->
</x-layout>
