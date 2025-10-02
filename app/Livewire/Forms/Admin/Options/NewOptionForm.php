<?php

namespace App\Livewire\Forms\Admin\Options;

use App\Models\Option;
use Livewire\Attributes\Validate;
use Livewire\Form;

class NewOptionForm extends Form
{
    // Creo los atributos públicos
    public $name;
    public $type = 1;
    public $features = [
        [
            'value' => '',
            'description' => '',
        ],
    ];

    // Cuando pulsemos nueva opción, se abre el modal. Mientras no lo pulsemos, muestra la vista de opciones directamente.
    public $openModal = false;

    public function rules()
    {
        $rules = ([
            'name' => 'required',
            'type' => 'required|in:1,2',
            'features' => 'required|array|min:1',
        ]);

        // Cada opción añadida, se hará su validación
        foreach ($this->features as $index => $feature) {

            if ($this->type == 1) {
                $rules['features.' . $index . '.value'] = 'required';
            } else {
                // color
                $rules['features.' . $index . '.value'] = 'required|regex:/^#[a-f0-9]{6}$/i';
            }
            $rules['features.' . $index . '.description'] = 'required';
        }

        return $rules;
    }

    public function validationAttributes()
    {
        $attributes = [
            'name' => 'nombre',
            'type' => 'tipo',
            'features' => 'valores',
        ];

        foreach ($this->features as $index => $feature) {
            $attributes['features.' . $index . '.value'] = 'valor ' . ($index + 1);
            $attributes['features.' . $index . '.description'] = 'descripción ' . ($index + 1);
        }

        return $attributes;
    }

    public function addFeature()
    {
        // Cuando pulsemos el botón agregar valor, agrega un nuevo feature (array)
        $this->features[] = [
            'value' => '',
            'description' => '',
        ];
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function save()
    {
        $this->validate();

        $option = Option::create([
            'name' => $this->name,
            'type' => $this->type,
        ]);

        // Creamos los features haciendo relación con los options
        foreach ($this->features as $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description'],
            ]);
        }

        $this->reset();
    }
}
