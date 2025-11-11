<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Actualizar todos los productos existentes con la misma imagen
        Product::query()->update([
            'image_path' => 'products/z4CkZvU21hb0DPow82k2rlGDqYnswHkH6k4hPHdG.png'
        ]);
    }
}
