<?php

namespace App\Livewire\Admin\Options;

use App\Models\Option;
use Livewire\Component;

class ManageOptions extends Component
{
    public $options;

    public $newOption = [
        'name' => '',
        'type' => 1,
        'features' => [
            [
                'value' => '',
                'description' => '',
            ]
        ]
    ];

    // Cuando pulsemos nueva opción, se abre el modal. Mientras no lo pulsemos, muestra la vista de opciones directamente.
    public $openModal = true;

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

    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}
