@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <!-- Background Slides -->
        <div class="hero-slide" style="background-image: url('https://i.pinimg.com/736x/b9/08/79/b908792c816dc17c0fb41d40e4921841.jpg');"></div>
        <div class="hero-slide" style="background-image: url('https://i.pinimg.com/736x/62/6b/36/626b366e9c3f0fcee7aea2d34d895ffa.jpg');"></div>
        <div class="hero-slide active" style="background-image: url('https://i.pinimg.com/736x/7d/b4/3e/7db43e5eaf63da07dfdeb0e6bb4bdc5f.jpg');"></div>
        <div class="hero-slide" style="background-image: url('https://i.pinimg.com/736x/25/de/a8/25dea8a9b862a06857e59a4d01388e5f.jpg');"></div>

       
        
        <div class="container">
            <div class="hero-content" data-aos="fade-right" data-aos-delay="200">
                <p class="hero-subtitle">Welcome to Ahavor Foods</p>
                <h1 class="hero-title">Nutritious & Delicious Food Products</h1>
                <p class="hero-description">Experience the perfect blend of nutrition and taste with our premium food products made from the finest ingredients.</p>
                <div class="hero-buttons">
                    <a href="{{ route('products') }}" class="cta-button pulse">Explore Products</a>
                    <a href="{{ route('about') }}" class="secondary-button">Learn More</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Products Section (Now Dynamic) -->
    <section class="section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <p class="section-subtitle">Our Products</p>
                <h2 class="section-title">Our Featured Products</h2>
                <p class="section-description">Discover our range of nutritious and delicious food products made with love and care.</p>
            </div>
            
            <div class="products-grid">
                @foreach($featuredProducts as $product)
                    <div class="product-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="product-image-container">
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="product-image blur-load">
                            <div class="product-badge">Best Seller</div>
                        </div>
                        <div class="product-content">
                            <p class="product-category">{{ $product->category->name }}</p>
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-description">{{ $product->description }}</p>
                            <p class="product-price">GH₵ {{ $product->sale_price ?? $product->regular_price }}</p>
                            <a href="{{ route('products') }}" class="product-button">Add to Cart</a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center" style="margin-top: 50px;" data-aos="fade-up">
                <a href="{{ route('products') }}" class="cta-button">View All Products</a>
            </div>
        </div>
    </section>
    
    <!-- About Section -->
    <section class="section about-section">
        <div class="container">
            <div class="about-container">
                <div class="about-content" data-aos="fade-right">
                    <p class="about-subtitle">About Us</p>
                    <h2 class="about-title">Our Story</h2>
                    <p class="about-description">Ahavor Foods combines the Hebrew words for "love" and "light" to bring you nutritious, delicious food products made with care and passion. Our mission is to empower young entrepreneurs and provide healthy food options for all.</p>
                    <p class="about-description">We are committed to using only the finest ingredients and traditional methods to create products that nourish both body and soul.</p>
                    
                    <div class="about-features">
                        <div class="about-feature">
                            <div class="feature-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div class="feature-text">100% Natural Ingredients</div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="feature-text">Premium Quality</div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="feature-text">Made with Love</div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <div class="feature-text">Sustainable Practices</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('about') }}" class="cta-button">Learn More About Us</a>
                </div>
                
                <div class="about-image-container" data-aos="fade-left">
                    <img src="https://i.pinimg.com/736x/a2/3d/32/a23d32f28abfa421e15f7add803831f4.jpg" alt="About Ahavor Foods" class="about-image blur-load">
                </div>
            </div>
        </div>
    </section>
    <div class="about-image-container" data-aos="fade-left">
     <img src="https://i.pinimg.com/736x/c9/41/62/c941622d51b040ab80396b3a56eaf5b4.jpg" alt="About Ahavor Foods" class="about-image blur-load">
    </div>
    <!-- Testimonials Section (Now Dynamic) -->
    <section class="section testimonials-section">
        <div class="container testimonials-container">
            <div class="section-header" data-aos="fade-up">
                <p class="section-subtitle">Testimonials</p>
                <h2 class="section-title">What Our Customers Say</h2>
                <p class="section-description">Don't just take our word for it. Here's what our satisfied customers have to say about our products.</p>
            </div>
            
            <div class="testimonials-grid">
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                        <p class="testimonial-content">"{{ $testimonial->message }}"</p>
                        <div class="testimonial-author">
                            <div class="author-info">
                                <h4 class="author-name">{{ $testimonial->name }}</h4>
                                <p class="author-title">{{ $testimonial->title }}</p>
                                <img src="{{ asset($testimonial->image_path) }}" alt="{{ $testimonial->name }}" class="author-image">
                                <div class="testimonial-rating">
                                    @for ($i = 0; $i < floor($testimonial->rating); $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @if ($testimonial->rating - floor($testimonial->rating) > 0)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section" style="background-image: url('{{ asset('images/cta-bg.jpg') }}');">
        <div class="container">
            <div class="cta-content" data-aos="zoom-in">
                <h2 class="cta-title">Ready to Experience the Ahavor Difference?</h2>
                <p class="cta-description">Join thousands of satisfied customers who have made Ahavor Foods a part of their healthy lifestyle.</p>
                <a href="{{ route('products') }}" class="cta-button-white">Shop Now</a>
            </div>
        </div>
    </section>
@endsection


@section('additional_scripts')
<script>
    // Product card hover effect
    document.addEventListener('DOMContentLoaded', function() {
        const productCards = document.querySelectorAll('.product-card');
        
        productCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px)';
                this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.08)';
            });
        });
         // Hero Background Slider
         const heroSlides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;
        
        function nextSlide() {
            // Remove active class from current slide
            heroSlides[currentSlide].classList.remove('active');
            
            // Calculate next slide index
            currentSlide = (currentSlide + 1) % heroSlides.length;
            
            // Add active class to next slide
            heroSlides[currentSlide].classList.add('active');
        }
        
        // Change slide every 5 seconds
        setInterval(nextSlide, 5000);
    });
    
</script>
@endsection