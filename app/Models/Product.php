<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'sku', 'description', 'category_id', 'brand_id',
        'price', 'sale_price', 'stock', 'min_order_qty', 'max_order_qty',
        'thumbnail_image', 'gallery_images', 'video_url',
        'color', 'size', 'weight', 'warranty',
        'meta_title', 'meta_description', 'meta_keywords',
        'tax_rate', 'shipping_cost',
        'is_trending', 'is_new_arrival', 'status'
    ];

    // JSON aur Boolean ko sahi format me convert karne ke liye
    protected $casts = [
        'gallery_images' => 'array', // JSON ko array banayega
        'is_trending' => 'boolean',
        'is_new_arrival' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}