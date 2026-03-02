<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'regular_price', 'sale_price', 'description', 'image_path', 'category_id'];

    // Define relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function nutrition()
    {
        return $this->hasOne(Nutrition::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
