@extends('layouts.main')

@section('title', $post->title)

@section('content')
    <!-- Breadcrumbs -->
    @php
        $breadcrumbs = [
            ['title' => 'Blog', 'url' => route('blog')],
            ['title' => $post->title, 'url' => '']
        ];
    @endphp
    
    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    
    <!-- Blog Detail Section -->
    <section class="section">
        <div class="container">
            <div class="blog-detail-container">
                <div class="blog-detail-main">
                    <!-- Featured Image -->
                    <div class="blog-detail-image">
                        <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}" class="blur-load">
                    </div>
                    
                    <!-- Post Meta -->
                    <div class="blog-detail-meta">
                        <span><i class="far fa-calendar"></i> {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Not Published' }}</span>

                        <span><i class="far fa-user"></i> {{ $post->author->name }}</span>
                        <span><i class="far fa-folder"></i> {{ $post->category->name }}</span>
                    </div>
                    
                    <!-- Post Title -->
                    <h1 class="blog-detail-title">{{ $post->title }}</h1>
                    
                    <!-- Post Content -->
                    <div class="blog-detail-content">
                        {!! $post->content !!}
                    </div>
                    
                    <!-- Tags -->
                    <div class="blog-detail-tags">
                        <h3>Tags:</h3>
                        <div class="tags-cloud">
                            @foreach($tags as $tag)
                            <a href="{{ route('blog', ['tag' => $tag->slug]) }}" class="tag">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Related Posts -->
                    <div class="related-posts">
                        <h3>Related Posts</h3>
                        <div class="related-posts-grid">
                            @foreach($relatedPosts as $relatedPost)
                            <div class="related-post-card">
                                <div class="related-post-image">
                                    <a href="{{ route('blog.detail', $relatedPost->slug) }}">
                                    <img src="{{ filter_var($relatedPost->image_path, FILTER_VALIDATE_URL) ? $relatedPost->image_path : asset($relatedPost->image_path) }}" alt="{{ $relatedPost->title }}" class="blur-load">

                                    </a>
                                </div>
                                <div class="related-post-content">
                                    <h4>
                                        <a href="{{ route('blog.detail', $relatedPost->slug) }}">{{ $relatedPost->title }}</a>
                                    </h4>
                                    <div class="related-post-date">
                                    <i class="far fa-calendar"></i> {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Not Published' }}

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
                                    <i class="far fa-calendar"></i> 
                                        {{ $recentPost->created_at ? \Carbon\Carbon::parse($recentPost->created_at)->format('M d, Y') : 'Not Published' }}

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 