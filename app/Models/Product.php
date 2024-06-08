<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'name',
        'description',
        'price',
        'image',
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
