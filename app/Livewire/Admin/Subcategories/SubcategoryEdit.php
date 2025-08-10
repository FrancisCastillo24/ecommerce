<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    // Variable donde se pasa el objeto seleccionado para editar y su relación (familia)
    public $subcategory;
    public $families;

    public $subcategoryEdit = [
        'family_id' =>  '',
        'category_id' => '',
        'name' => '',
    ];

    // Método para recuperar todo el listado y su información en un array aparte
    public function mount($subcategory)
    {
        $this->families = Family::all();

        $this->subcategoryEdit = [
            'family_id' => $subcategory->category->family_id,
            'category_id' => $subcategory->category_id,
            'name' => $subcategory->name
        ];
    }

    public function updatedSubcategoryFamilyId()
    {
        // dd('Cambio');
        $this->subcategoryEdit['category_id'] = '';
    }

    // Es una propiedad computada para acceder a ese método como una propiedad
    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subcategoryEdit['family_id'])->get();
    }

    public function save()
    {
        // dd($this->subcategory);
        $this->validate([
            'subcategoryEdit.family_id' => 'required|exists:families,id',
            'subcategoryEdit.category_id' => 'required|exists:categories,id',
            'subcategoryEdit.name' => 'required',
        ], [], [ // Ponemos este array para que cuando valide campos muestre el mensaje traducido
            'subcategoryEdit.family_id' => 'familia',
            'subcategoryEdit.category_id' => 'categoría',
            'subcategoryEdit.name' => 'nombre',
        ]);

        $this->subcategory->update($this->subcategoryEdit);

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Subfamilia actualizada correctamente.'
        ]);
    }


    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }
}
