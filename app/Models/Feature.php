<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'value',
        'description',
        'option_id',
    ];

    // Relación uno a muchos inversa, una carasterística pertenece a UNA opción
    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    // Relación uno a muchos, una carasterística puede estar en muchas variantes.
    public function variants()
    {
        return $this->belongsToMany(Variant::class)
            ->withTimestamps();
    }
}
