@extends('layouts.main')

@section('title', 'Our Products - Ahavor Foods')

@section('content')
<!-- Products Hero Section -->
<!-- Products Hero Section -->
<section class="products-hero">
    <div class="container">
        <div class="products-hero-content">
            <h1 class="products-hero-title">Our Products</h1>
            <p class="products-hero-description">Discover our range of nutritious and delicious products.</p>
            <div class="products-filter">
                <a href="{{ route('products') }}" class="filter-button {{ !isset($category) ? 'active' : '' }}">All Products</a>
                @foreach($categories as $cat)
                    <a href="{{ route('products.category', $cat->slug) }}" class="filter-button {{ isset($category) && $category->id == $cat->id ? 'active' : '' }}">{{ $cat->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Products Grid Section -->
<section class="section">
    <div class="container">
        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card" data-aos="fade-up">
                <a href="{{ route('product.detail', $product->slug) }}" class="product-link">
                    <div class="product-image-container">
                        <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="product-image blur-load">
                    </div>
                    <div class="product-content">
                        <p class="product-category">{{ $product->category->name }}</p>
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <p class="product-price">₵{{ $product->sale_price ?? $product->regular_price }}</p>
                        <button class="product-button">Add to Cart</button>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section about-section">
        <div class="container">
            <div class="about-container">
                <div class="about-content" data-aos="fade-right">
                    <h2 class="about-title">Discover Quality</h2>
                    <p class="about-description">At Ahavor Foods, we bring you a collection of high-quality, nutritious food products crafted with love and expertise. From fresh organic ingredients to expertly made delicacies, each product reflects our commitment to excellence.</p>
                    <p class="abouts-description">Our range is carefully curated to offer you the finest flavors, backed by sustainable practices and a dedication to health and wellness.</p>
                    
                    <div class="about-features">
                        
                            <div class="about-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-apple-alt"></i>
                                </div>
                                <div class="feature-text">Fresh & Organic</div>
                            </div>
                            <div class="about-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="feature-text">Superior Taste</div>
                            </div>
                        
                        
                            <div class="about-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-hand-holding-heart"></i>
                                </div>
                                <div class="feature-text">Ethically Sourced</div>
                            </div>
                            <div class="about-feature">
                                <div class="feature-icon">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <div class="feature-text">Eco-Friendly Packaging</div>
                            </div>
                        
                    </div>
                    
                    <a href="{{ route('products') }}" class="cta-button">Explore Our Products</a>
                </div>
                
                <div class="products-image-container" data-aos="fade-left">
                    <img src="https://i.pinimg.com/736x/27/eb/a1/27eba13c0f5bd772c7997deff0f82521.jpg" alt="Ahavor Foods Products" class="about-image blur-load">
                </div>
            </div>
        </div>
</section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2 class="newsletter-title">Stay Updated</h2>
                <p class="newsletter-description"> Subscribe to our newsletter to receive updates on new products.</p>
                
                <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <input type="email" class="newsletter-input" name="email" placeholder="Enter your email address" required>
                    <button type="submit" class="newsletter-button">Subscribe</button>
                </form>
            </div>
            @if(session('newsletter_success'))
                <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('newsletter_success') }}
                </div>
            @endif
            @if($errors->has('email'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ $errors->first('email') }}
                </div>
            @endif

        </div>
    </section>
@endsection
