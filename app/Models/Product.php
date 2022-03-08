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

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function productPrice($price_type_id = 1) {
        $today = date('Y-m-d H:i:s');
        //return $this->productPrices()->where('active_date','>=', $today)->where('price_type_id', $price_type_id)->first()->price;
       return dd($this->productPrices());
    }
}
