<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeProductLabels extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany(LabelProduct::class, 'homeLabel_id', 'id');
    }
    protected $fillable=[
        'name',
    ];

}
