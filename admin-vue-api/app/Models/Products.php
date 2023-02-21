<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        "Product_Name",
        "Pricesell",
        "Qty",
        "Category_id",
    ];

    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'id', 'Category_id');
    }
}
