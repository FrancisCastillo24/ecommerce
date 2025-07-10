<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    // Relación uno a muchos, una familia puede tener muchas categorías
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
