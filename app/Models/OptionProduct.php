<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OptionProduct extends Pivot
{
    use HasFactory;

    // Cuando se almacene el campo feature, lo codifica y descodifica (json)
    protected $casts = [
        'features' => 'array'
    ];
}
