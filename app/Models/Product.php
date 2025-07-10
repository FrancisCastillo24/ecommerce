<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Relación uno a muchos inversa, un producto pertenece a una sola subcategoría
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // Relación uno a muchos, un producto tiene muchas variantes
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    // Relación uno a muchos, un producto tiene a una sola opción (solo existen dos campos, product_id y option_id)
    public function options()
    {
        return $this->belongsTo(Option::class)
            ->withPivot('value') // Quiero que me recupere el valor del atributo value
            ->withTimestamps();
    }
}
