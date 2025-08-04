<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retornamos la vista de categorías, usamos with para evitar demasiadas consultas a la base de datos
        $categories = Category::orderBy('id', 'desc')->with('family')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retornamos la vista de formulario
        $families = Family::all();
        return view('admin.categories.create', compact('families'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Almacenamos los datos en la base de datos
        $request->validate([
            'family_id' => 'required|exists:families,id',
            'name' => 'required',
        ]);

        Category::create($request->all());

        // Esto es para mostrar el mensaje alert
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Categoría creada correctamente.'
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        $families = Family::all();
        return view('admin.categories.edit', compact('category', 'families'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'family_id' => 'required|exists:families,id',
            'name' => 'required',
        ]);

        $category->update($request->all());


        // Esto es para mostrar el mensaje alert
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Categoría actualizada correctamente.'
        ]);

        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        if ($category->subcategories()->count() > 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Ups!',
                'text' => 'No se puede eliminar la categoría porque tiene subcategorías asociadas.'
            ]);

            return redirect()->route('admin.categories.edit', $category);
        }
        $category->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Categoría eliminada correctamente.'
        ]);


        return redirect()->route('admin.categories.index');
    }
}
