<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function show($id) // Recibe el ID de la subcategoría
    {
        // Busca la subcategoría con su categoría y la familia de esa categoría
        $subcategory = Subcategory::with('category.family')->findOrFail($id);

        return view('subcategories.show', compact('subcategory'));
    }
}
