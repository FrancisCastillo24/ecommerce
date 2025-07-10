<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'category_id',
    ];

    // Relación uno a muchos inversa, una subcategoría pertenece a UNA categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación uno a muchos inversa, una subcategoría tiene muchos productos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
