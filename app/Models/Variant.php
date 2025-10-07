<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Variant extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sku',
        'image_path',
        'product_id',
    ];

    protected function image() : Attribute
    {
        return Attribute::make(
            get: fn() => $this->image_path ? Storage::url($this->image_path) : asset('img/no-image2.jpeg')
        );
    }

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
