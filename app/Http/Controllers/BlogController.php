<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()->with('category', 'author')->latest()->published();
        $category = null; // Initialize the category variable
    
        if ($request->has('category')) {
            $categorySlug = $request->query('category');
            $category = Category::where('slug', $categorySlug)->first(); // Get the actual category object
            
            if ($category) {
                $query->whereHas('category', function($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            }
        }
    
        if ($request->has('tag')) {
            $tag = $request->query('tag');
            $query->whereHas('tags', function($q) use ($tag) {
                $q->where('slug', $tag);
            });
        }
    
        if ($request->has('search')) {
            $search = $request->query('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
    
        $posts = $query->paginate(9);
        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(10)->get();
        $recentPosts = Post::latest()->published()->limit(5)->get();
    
        return view('blog', compact('posts', 'categories', 'tags', 'recentPosts', 'category'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with('category', 'author', 'tags')->firstOrFail();
        $relatedPosts = Post::where('category_id', $post->category_id)
                            ->where('id', '!=', $post->id)
                            ->latest()
                            ->limit(3)
                            ->get();
        
        $categories = Category::withCount('posts')->get(); // ✅ Ensure categories exist
        $tags = Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(10)->get(); // ✅ Fetch tags
        $recentPosts = Post::latest()->published()->limit(5)->get(); // ✅ Add recent posts
    
        return view('blog-detail', compact('post', 'relatedPosts', 'categories', 'tags', 'recentPosts'));
    }

    public function category($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();
    
    $query = Post::query()->with('category', 'author')
                ->whereHas('category', function($q) use ($category) {
                    $q->where('id', $category->id);
                })
                ->latest();
    
    // Check if there are any published posts
    $publishedCount = Post::published()->count();
    
    // Only apply the published scope if there are published posts
    if ($publishedCount > 0) {
        $query->published();
    }
    
    $posts = $query->paginate(9);
    $categories = Category::withCount('posts')->get();
    $tags = Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(10)->get();
    
    $recentPostsQuery = Post::latest();
    if ($publishedCount > 0) {
        $recentPostsQuery->published();
    }
    $recentPosts = $recentPostsQuery->limit(5)->get();
    
    return view('blog', compact('posts', 'categories', 'tags', 'recentPosts', 'category'));
}

public function tag($slug)
{
    $tag = Tag::where('slug', $slug)->firstOrFail();
    
    $query = Post::query()->with('category', 'author')
                ->whereHas('tags', function($q) use ($tag) {
                    $q->where('id', $tag->id);
                })
                ->latest();
    
    // Check if there are any published posts
    $publishedCount = Post::published()->count();
    
    // Only apply the published scope if there are published posts
    if ($publishedCount > 0) {
        $query->published();
    }
    
    $posts = $query->paginate(9);
    $categories = Category::withCount('posts')->get();
    $tags = Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(10)->get();
    
    $recentPostsQuery = Post::latest();
    if ($publishedCount > 0) {
        $recentPostsQuery->published();
    }
    $recentPosts = $recentPostsQuery->limit(5)->get();
    
    // Pass the selected tag to the view
    $selectedTag = $tag;
    
    return view('blog', compact('posts', 'categories', 'tags', 'recentPosts', 'selectedTag'));
}
    
}
