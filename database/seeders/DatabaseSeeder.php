<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Container\Attributes\Storage;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        // User::factory(10)->create();

        // Se crea un usuario automáticamente
        User::factory()->create([
            'name' => 'Francisco Jesús',
            'email' => 'francis@gmail.com',
            'password' => bcrypt('Francis*1996')
        ]);

        // Aquí tengo todo el gran array de familias, categorías y subcategorías.
        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
        ]);

        Product::factory(150)->create();
    }
}
