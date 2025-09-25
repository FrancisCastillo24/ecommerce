<?php

namespace App\Livewire\Admin\Options;

use App\Models\Option;
use Livewire\Component;

class ManageOptions extends Component
{
    public $options;

    public $newOption = [
        'name' => '',
        'type' => 1, // Por defecto, color será el select seleccionado
        'features' => [
            [
                'value' => '',
                'description' => '',
            ]
        ]
    ];

    // Cuando pulsemos nueva opción, se abre el modal. Mientras no lo pulsemos, muestra la vista de opciones directamente.
    public $openModal = false;

    public function mount()
    {
        $this->options = Option::with('features')->get();
    }

    // Botón agregar valor
    public function addFeature()
    {
        // Cuando pulsemos el botón agregar valor, agrega un nuevo feature (array)
        $this->newOption['features'][] = [
            'value' => '',
            'description' => '',
        ];
    }

    // Botón que elimina una opción
    public function removeFeature($index) {
        unset($this->newOption['features'][$index]);
        $this->newOption['features'] = array_values($this->newOption['features']);
    }

    public function addOption()
    {
        $rules = ([
            'newOption.name' => 'required',
            'newOption.type' => 'required|in:1,2',
            'newOption.features' => 'required|array|min:1',
        ]);

        // Cada opción añadida, se hará su validación
        foreach ($this->newOption['features'] as $index => $feature) {    

            if ($this->newOption['type'] == 1) {
                $rules['newOption.features.' . $index . '.value'] ='required';
            }else{
                // color
                $rules['newOption.features.' . $index . '.value'] ='required|regex:/^#[a-f0-9]{6}$/i';
            }
            $rules['newOption.features.' . $index . '.description'] ='required';
        }

        $this->validate($rules);

        $option = Option::create([
            'name' => $this->newOption['name'],
            'type' => $this->newOption['type'],
        ]);

        // Creamos los features haciendo relación con los options
        foreach ($this->newOption['features'] as $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description'],
            ]);
        }

        $this->options = Option::with('features')->get();

        // Se resetea para cuando hayamos creado, se empiece de nuevo
        $this->reset('openModal', 'newOption');

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
