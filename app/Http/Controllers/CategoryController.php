<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
        public function show($id) // Recibe el ID de la categoría
    {
        // Busca la categoría con su familia y subcategorías
        $category = Category::with('family', 'subcategories')->findOrFail($id);

        return view('categories.show', compact('category'));
    }
}
