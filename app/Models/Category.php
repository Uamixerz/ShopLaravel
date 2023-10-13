<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class, 'product_id', 'id');
    }
    public function images(){
        return $this->hasMany(CategoryImage::class, 'category_id', 'id');
    }
    protected $fillable=[
        'id',
        'name',
        'description',
    ];
}
