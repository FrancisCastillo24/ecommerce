<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    // Relación uno a muchos
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->using(OptionProduct::class)
            ->withPivot('features') // Quiero que me recupere el valor del atributo feature
            ->withTimestamps();
    }

    // Relación uno a muchos, una opción tiene muchas carasterísticas (features)
    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}
