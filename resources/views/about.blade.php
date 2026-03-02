@extends('layouts.main')

@section('title', 'About Us - Ahavor Foods')

@section('content')
    <!-- About Hero Section -->
    <section class="about-hero" style="background-image: url('https://i.pinimg.com/736x/c9/41/62/c941622d51b040ab80396b3a56eaf5b4.jpg');">

        <div class="container">
            <div class="about-hero-content">
                <h1 class="about-hero-title">Our Story</h1>
                <p class="about-hero-description">
                    Discover how Ahavor Foods combines the Hebrew words for "love" and "light" to bring you nutritious, delicious food products made with care and passion.
                </p>
            </div>
        </div>
    </section>

    <!-- About Story Section -->
    <section class="about-story">
        <div class="container">
            <div class="about-story-container">
                <div class="about-story-content">
                    <p class="about-story-subtitle">Our Story</p>
                    <h2 class="about-story-title">A Journey of Love and Light</h2>
                    <p class="about-story-description">
                        Ahavor Foods was founded with a simple yet powerful mission: to bring nutritious, delicious food products to people while empowering young entrepreneurs. Our name combines the Hebrew words for "love" and "light," reflecting our commitment to creating products that nourish both body and soul.
                    </p>
                    <p class="about-story-description">
                        We believe in using only the finest ingredients and traditional methods to create products that are not just healthy, but also delicious. Every product we make is crafted with care, attention to detail, and a deep respect for the ingredients we use.
                    </p>
                </div>
                <div class="about-story-image">
                    <img src="{{ asset('images/group.jpg') }}" alt="Ahavor Foods Story" class="blur-load">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="about-values">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">Our Values</p>
                <h2 class="section-title">What We Stand For</h2>
                <p class="section-description">Our core values guide everything we do, from product development to customer service.</p>
            </div>
            
            <div class="values-grid">
                <!-- Value 1 -->
                <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="value-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="value-title">Natural Ingredients</h3>
                    <p class="value-description">
                        We use only 100% natural ingredients, free from artificial additives and preservatives.
                    </p>
                </div>
                
                <!-- Value 2 -->
                <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="value-title">Made with Love</h3>
                    <p class="value-description">
                        Every product is crafted with care and attention to detail, ensuring the highest quality.
                    </p>
                </div>
                
                <!-- Value 3 -->
                <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="value-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3 class="value-title">Sustainable Practices</h3>
                    <p class="value-description">
                        We are committed to sustainable and environmentally friendly production methods.
                    </p>
                </div>
                
                <!-- Value 4 -->
                <div class="value-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="value-title">Community Focus</h3>
                    <p class="value-description">
                        We support local communities and empower young entrepreneurs through our business.
                    </p>
                </div>

                <!-- Value 5 -->
                <div class="value-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="value-icon">
                    <i class="fas fa-balance-scale"></i> 
                    </div>
                    <h3 class="value-title">Impact Driven</h3>
                    <p class="value-description">
                        We believe the youth is a force, we have a treasure which we are not aware of, that is what we wannt to bring to awareness.
                    </p>
                </div>

                <!-- Value 5 -->
                <div class="value-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="value-icon">
                    <i class="fas fa-cross"></i>
                    </div>
                    <h3 class="value-title">Christ Driven</h3>
                    <p class="value-description">
                    There is no better place that the feet of God. We want the ehole world to see and know that christ is the only true way.
                    </p>
                </div>
            </div>
        </div>
    </section>

     <!-- Team Section -->
     <section class="about-team">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">Our Team</p>
                <h2 class="section-title">Meet the People Behind Ahavor</h2>
                <p class="section-description">Our dedicated team of professionals is committed to bringing you the best products.</p>
            </div>
            
            <div class="team-grid">
                @foreach($teamMembers as $member)
                    <div class="team-card" data-aos="fade-up">
                        <div class="team-image">
                            <img src="{{ asset($member->image_path) }}" alt="{{ $member->name }}" class="blur-load">
                        </div>
                        <div class="team-content">
                            <h3 class="team-name">{{ $member->name }}</h3>
                            <p class="team-position">{{ $member->position }}</p>
                            <p class="team-description">{{ $member->bio }}</p>
                            
                            <div class="team-social">
                                @if(isset($member->social_links['linkedin'])) 
                                    <a href="{{ $member->social_links['linkedin'] }}" class="social-link"><i class="fab fa-linkedin-in"></i></a> 
                                @endif

                                @if(isset($member->social_links['twitter'])) 
                                    <a href="{{ $member->social_links['twitter'] }}" class="social-link"><i class="fab fa-twitter"></i></a> 
                                @endif

                                @if(isset($member->social_links['instagram'])) 
                                    <a href="{{ $member->social_links['instagram'] }}" class="social-link"><i class="fab fa-instagram"></i></a> 
                                @endif
                                
                                @if(isset($member->social_links['facebook'])) 
                                    <a href="{{ $member->social_links['facebook'] }}" class="social-link"><i class="fab fa-facebook-f"></i></a> 
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- CTA Section -->
    <section class="about-cta" style="background-image: url('{{ asset('images/about-cta.jpg') }}');">
        <div class="container">
            <div class="about-cta-content">
                <h2 class="about-cta-title">Join Our Journey</h2>
                <p class="about-cta-description">
                    Experience the perfect blend of nutrition and taste with our premium food products. Join us in our mission to bring healthy, delicious food to everyone.
                </p>
                <a href="{{ route('products') }}" class="cta-button">Explore Our Products</a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Blur loading effect for images
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.style.filter = 'blur(5px)';
            img.onload = function() {
                // Start with blur and gradually remove it
                let blur = 5;
                const interval = setInterval(() => {
                    blur -= 0.5;
                    if (blur <= 0) {
                        clearInterval(interval);
                        img.style.filter = 'none';
                    } else {
                        img.style.filter = `blur(${blur}px)`;
                    }
                }, 50);
            };
        });
    });
</script>
@endsection