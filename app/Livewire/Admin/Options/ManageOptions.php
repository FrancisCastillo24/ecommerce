<?php

namespace App\Livewire\Admin\Options;

use App\Livewire\Forms\Admin\Options\NewOptionForm;
use App\Models\Feature;
use App\Models\Option;
use Livewire\Attributes\On;
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

    // Método para que no sea necesario recargar página para ver los cambios
    #[On('featureAdded')]
    public function updateOptionList()
    {
        $this->options = Option::with('features')->get();
    }

    // Botón agregar valor
    public function addFeature()
    {
        $this->newOption->addFeature();
    }

    // Botón que elimina una opción dentro del modal
    public function removeFeature($index)
    {
        $this->newOption->removeFeature($index);
    }

    // Botón que elimina un feature fuera del modal
    public function deleteFeature(Feature $feature)
    {
        $feature->delete();
        $this->options = Option::with('features')->get();
    }

    public function deleteOption(Option $option)
    {
        $option->delete();
        $this->options = Option::with('features')->get();
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
