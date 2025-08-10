<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retorna la vista de familia ordenado de forma descendente
        $families = Family::orderBy('id', 'desc')->paginate();
        return view('admin.families.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna el formulario de familia
        return view('admin.families.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Recogemos los datos del fomulario y lo almacenamos en la BBDD
        $request->validate([
            'name' => 'required'
        ]);

        Family::create($request->all());

        // Esto es para mostrar el mensaje alert
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Familia creada correctamente.'
        ]);

        return redirect()->route('admin.families.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        return view('admin.families.edit', compact('family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
    {

        $request->validate([
            'name' => 'required'
        ]);

        $family->update($request->all());

        // Esto es para mostrar el mensaje alert
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Familia actualizada correctamente.'
        ]);

        return redirect()->route('admin.families.edit', $family);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        if ($family->categories->count() > 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Ups!',
                'text' => 'No se puede eliminar la familia porque tiene categorías asociadas.'
            ]);

            return redirect()->route('admin.families.edit', $family);
        }
        $family->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Familia eliminada correctamente.'
        ]);


        return redirect()->route('admin.families.index');
    }
}
