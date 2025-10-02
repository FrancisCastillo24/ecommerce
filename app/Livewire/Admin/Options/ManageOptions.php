<?php

namespace App\Livewire\Admin\Options;

use App\Livewire\Forms\Admin\Options\NewOptionForm;
use App\Models\Option;
use Livewire\Component;

class ManageOptions extends Component
{
    public $options;

    // Se instancia la clase para formulario
    public NewOptionForm $newOption;

    public function mount()
    {
        $this->options = Option::with('features')->get();
    }

    // Botón agregar valor
    public function addFeature()
    {
        $this->newOption->addFeature();
    }

    // Botón que elimina una opción
    public function removeFeature($index) 
    {
        $this->newOption->removeFeature($index);
    }

    public function addOption()
    {

        $this->newOption->save();

        $this->options = Option::with('features')->get();

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => '¡La opción se agregó correctamente!',
        ]);

    }

    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}
