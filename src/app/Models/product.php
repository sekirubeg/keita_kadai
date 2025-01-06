<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',         // 必要に応じて追加
        'name',
        'price',
        'text',
        'season',
        'image',
    ];
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season');
    }
}
