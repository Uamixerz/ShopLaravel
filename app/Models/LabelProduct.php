<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelProduct extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function label(){
        return $this->belongsTo(HomeProductLabels::class, 'homeLabel_id', 'id');
    }
    protected $fillable =[
        'product_id',
        'homeLabel_id'
    ];
}
