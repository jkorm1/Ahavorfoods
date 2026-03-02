@extends('layouts.main')

@section('title', '{{ $product->name }} - Ahavor Foods')

@section('content')
<!-- Product Detail Hero -->


<!-- Product Detail Main -->
<section class="product-detail-main">
    <div class="container">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="product-images">
                    <div class="product-main-image">
                        <img id="main-product-image" src="{{ asset($product->image_path) }}" class="img-fluid">
                        <div class="image-overlay">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </div>

                    <!-- Product Thumbnails -->
                    @if($product->images && $product->images->count() > 0)
                        <div class="product-thumbnails">
                            @foreach($product->images as $image)
                            <div class="thumbnail">
                            <img src="{{ asset($image->path) }}" alt="Thumbnail">

                            </div>
                            @endforeach
                        </div>
                    @else
                        <p>No images available for this product.</p>
                    @endif

                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="product-category">{{ $product->category->name }}</p>
                <div class="product-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-count">{{ $product->rating }} / 5</span>
                </div>
                <p class="product-price">₵{{ $product->sale_price ?? $product->regular_price }}</p>
                <p class="product-description">{{ $product->description }}</p>

                <!-- Product Meta -->
                <div class="product-meta">
                    <div class="meta-item">
                        <i class="fas fa-check-circle"></i>
                        <span class="meta-title">Availability:</span>
                        <span class="meta-value {{ $product->stock > 0 ? 'in-stock' : '' }}">{{ $product->stock > 0 ? 'In Stock' : 'Stock' }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-weight-hanging"></i>
                        <span class="meta-title">Weight:</span>
                        <span class="meta-value">{{ $product->weight }}g</span>
                    </div>
                </div>

                <!-- Add to Cart & Wishlist -->
                <!-- Update the product actions section in your product-detail.blade.php -->
                <div class="product-actions">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="quantity-selector">
                            <button type="button" class="quantity-btn minus-btn">-</button>
                            <input type="number" name="quantity" class="quantity-input" value="1" min="1" max="{{ $product->stock }}">
                            <button type="button" class="quantity-btn plus-btn">+</button>
                        </div>
                        <div class="action-buttons">
                            <button type="submit" onclick="this.closest('form').submit();" class="product-button">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>

                            </button>
                            <button type="button" class="wishlist-btn"><i class="fas fa-heart"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nutrition Facts -->
@if($product->nutrition)
    <section class="product-detail-section nutrition-facts">
        <div class="container">
            <h3>Nutrition Facts</h3>
            <table class="nutrition-table">
                <tr><th>Calories</th><td>{{ $product->nutrition->calories }}</td></tr>
                <tr><th>Protein</th><td>{{ $product->nutrition->protein }}g</td></tr>
                <tr><th>Carbs</th><td>{{ $product->nutrition->carbs }}g</td></tr>
                <tr><th>Fat</th><td>{{ $product->nutrition->fat }}g</td></tr>
            </table>
        </div>
    </section>
@else
    <div class="container">
        <div class="no-content-message">
            <i class="fas fa-info-circle"></i>
            <p>No nutrition information available for this product.</p>
        </div>
    </div>
@endif

<!-- Customer Reviews -->
<section class="product-detail-section reviews-section">
    <div class="container">
        <h3>Customer Reviews</h3>
        @if($product->reviews && $product->reviews->count() > 0)
            <div class="reviews-wrapper">
            <div class="reviews-list">
                @foreach($product->reviews as $review)
                <div class="review-item">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <img src="{{ asset($review->user->avatar ?? 'images/jay.jpg') }}" class="reviewer-avatar">
                            <div>
                                <p class="reviewer-name">{{ $review->user->name }}</p>
                                <p class="review-date">{{ $review->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="stars">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                    </div>
                    <p class="review-title">{{ $review->title }}</p>
                    <p class="review-content">{{ $review->content }}</p>
                </div>
                @endforeach
            </div>
            </div>
        @else
            <div class="no-content-message">
                <i class="fas fa-comment-slash"></i>
                <p>No reviews available for this product yet. Be the first to leave a review!</p>
            </div>
        @endif
    </div>
</section>

<!-- Shipping Information -->
<section class="shipping-info">
    <div class="container">
        <h3>Shipping & Delivery</h3>
        <p>{{ $product->shipping_details ?? 'We offer fast and reliable shipping for all our products.' }}</p>
        <ul>
            <li><i class="fas fa-truck"></i> Fast nationwide delivery</li>
            <li><i class="fas fa-box-open"></i> Secure packaging</li>
            <li><i class="fas fa-shield-alt"></i> Satisfaction guaranteed</li>
            <li><i class="fas fa-undo"></i> Easy returns within 14 days</li>
        </ul>
    </div>
</section>


<!-- Related Products -->
<section class="related-products">
    <div class="container">
        <h2 class="section-title">You May Also Like</h2>
        <div class="related-products-grid">
            @foreach($relatedProducts as $related)
            <div class="product-card">
                @if($related->is_new || $related->is_featured)
                    <div class="product-badge">
                        {{ $related->is_new ? 'New' : 'Featured' }}
                    </div>
                @endif
                <div class="product-image-container">
                    <img src="{{ asset($related->image_path) }}" alt="{{ $related->name }}">
                </div>
                <div class="card-body">
                    <h5><a href="{{ route('product.detail', $related->slug) }}">{{ $related->name }}</a></h5>
                    <p>₵{{ $related->sale_price ?? $related->regular_price }}</p>
                    <a href="{{ route('product.detail', $related->slug) }}" class="btn-view">View Product</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const minusBtns = document.querySelectorAll('.minus-btn');
        const plusBtns = document.querySelectorAll('.plus-btn');

        minusBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.closest('.quantity-selector').querySelector('.quantity-input');
                let value = parseInt(input.value);
                if (value > 1) {
                    input.value = value - 1;
                    input.dispatchEvent(new Event('input')); // 🚀 Forces the browser to visually update
                }
            });
        });

        plusBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.closest('.quantity-selector').querySelector('.quantity-input');
                let value = parseInt(input.value);
                input.value = value + 1;
                input.dispatchEvent(new Event('input')); // 🚀 Forces the browser to visually update
            });
        });

        const reviewsList = document.querySelector(".reviews-list");

        function scrollReviews() {
            reviewsList.style.transition = "transform 20s linear";
            reviewsList.style.transform = `translateX(-${reviewsList.scrollWidth}px)`;
            setTimeout(() => {
                reviewsList.style.transition = "none";
                reviewsList.style.transform = "translateX(0)";
            }, 20000);
        }

        setInterval(scrollReviews, 20000);
    });

    
    
</script>
