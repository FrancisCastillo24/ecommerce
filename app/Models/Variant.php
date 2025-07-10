<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    // Relación uno a muchos inversa, una variante pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relación uno a muchos
    public function features()
    {
        return $this->belongsToMany(Feature::class)
            ->withTimestamps();
    }
}
