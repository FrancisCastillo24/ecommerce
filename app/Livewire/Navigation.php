<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Navigation extends Component
{
    public $families;
    public $family_id;

    public function mount()
    {
        $this->families = \App\Models\Family::all();

        // Validar que haya al menos una familia
        if ($this->families->isNotEmpty()) {
            $this->family_id = $this->families->first()->id;
        } else {
            $this->family_id = null; // O asigna un valor por defecto
        }
    }

    #[Computed()]
    public function categories()
    {
        if (!$this->family_id) {
            return collect(); // Retorna colección vacía si no hay familia
        }

        return \App\Models\Category::where('family_id', $this->family_id)
            ->with('subcategories')
            ->get();
    }

    #[Computed()]
    public function familyName()
    {
        if (!$this->family_id) {
            return ''; // Retorna vacío si no hay familia
        }

        $family = \App\Models\Family::find($this->family_id);
        return $family ? $family->name : '';
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
