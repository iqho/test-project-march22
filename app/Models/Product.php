<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductPrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'description', 'image', 'is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function price_info()
    {
        return $this->hasMany(ProductPrice::class, 'product_id');
    }

    
}