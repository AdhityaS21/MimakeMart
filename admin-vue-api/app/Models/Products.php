<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        "Product_image",
        "Product_Name",
        "Pricesell",
        "Qty",
        "Category_id",
    ];

    public function getImageAttribute($value)
    {
        return Storage::url("image/" . $value);
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'id', 'Category_id');
    }
}
