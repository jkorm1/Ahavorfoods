@extends('layouts.main')

@section('title', $category->name ?? 'Blog')


    @section('content')
    <!-- Breadcrumbs -->
    @php
        $breadcrumbs = [
            ['title' => 'Blog', 'url' => route('blog')]
        ];
        
        if(isset($category)) {
            $breadcrumbs[] = ['title' => $category->name, 'url' => ''];
        }
    @endphp
    
    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    
    <!-- Blog Header -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h3 class="section-subtitle">Our Blog</h3>
                <h2 class="section-title">{{ isset($category) ? $category->name : 'Latest Articles' }}</h2>
                <p class="section-description">Stay updated with nutrition tips, recipes, and company news</p>
            </div>
            
            <div class="blog-container">
                <div class="blog-main">
                    <div class="blog-grid">
                    @if($posts->count() > 0)
                        @foreach($posts as $post)
                            <div class="blog-card" data-aos="fade-up">
                                <div class="blog-image">
                                    <a href="{{ route('blog.detail', $post->slug) }}">
                                    <img src="{{ filter_var($post->image_path, FILTER_VALIDATE_URL) ? $post->image_path : asset($post->image_path) }}" alt="{{ $post->title }}" class="blur-load">

                                    </a>
                                    <div class="blog-category">{{ $post->category->name ?? 'Uncategorized' }}</div>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                    <span><i class="far fa-calendar"></i> {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Not Published' }}</span>


                                        <span><i class="far fa-user"></i> {{ $post->author->name }}</span>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="{{ route('blog.detail', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="blog-excerpt">{{ Str::limit($post->excerpt, 120) }}</p>
                                    <a href="{{ route('blog.detail', $post->slug) }}" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <p>No results found for your search.</p>
                    @endif
                </div>
                    
                    <!-- Pagination -->
                    <div class="pagination-container">
                        {{ $posts->links() }}
                    </div>
                </div>
                
                <div class="blog-sidebar">
                    <!-- Search Widget -->
                    <div class="sidebar-widget search-widget">
                        <h3 class="widget-title">Search</h3>
                        <form action="{{ route('blog') }}" method="GET" class="search-form">
                            <div class="search-input">
                                <input type="text" name="search" placeholder="Search articles..." value="{{ request('search') }}">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Categories Widget -->
                    <div class="sidebar-widget categories-widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="categories-list">
                            @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('blog.category', $cat->slug) }}">
                                    {{ $cat->name }}
                                    <span>({{ $cat->posts_count }})</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <!-- Recent Posts Widget -->
                    <div class="sidebar-widget recent-posts-widget">
                        <h3 class="widget-title">Recent Posts</h3>
                        <div class="recent-posts">
                            @foreach($recentPosts as $recentPost)
                            <div class="recent-post-item">
                                <div class="recent-post-image">
                                    <a href="{{ route('blog.detail', $recentPost->slug) }}">
                                    <img src="{{ filter_var($recentPost->image_path, FILTER_VALIDATE_URL) ? $recentPost->image_path : asset($recentPost->image_path) }}" alt="{{ $recentPost->title }}">
                                    </a>
                                </div>
                                <div class="recent-post-info">
                                    <h4>
                                        <a href="{{ route('blog.detail', $recentPost->slug) }}">{{ Str::limit($recentPost->title, 40) }}</a>
                                    </h4>
                                    <div class="recent-post-date">
                                    <i class="far fa-calendar"></i> {{ $recentPost->published_at ? \Carbon\Carbon::parse($recentPost->published_at)->format('M d, Y') : 'Not Published' }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Tags Widget -->
                    <div class="sidebar-widget tags-widget">
                        <h3 class="widget-title">Popular Tags</h3>
                        <div class="tags-cloud">
                            @foreach($tags as $tag)
                            <a href="{{ route('blog', ['tag' => $tag->slug]) }}" class="tag">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection