<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'family_id',
    ];

    // Relación uno muchos inversa, cada categoría pertenece a una familia
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    // Relación uno a muchos, una categoría puede tener múltiples subcategorías
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
