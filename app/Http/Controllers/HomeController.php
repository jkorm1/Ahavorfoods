<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // ✅ Import Product model
use App\Models\Testimonial; // ✅ Import Testimonial model

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::query()->limit(4)->get(); // ✅ Correct usage
        $testimonials = Testimonial::latest()->limit(3)->get();
        
        return view('home', compact('featuredProducts', 'testimonials'));
    }
}
