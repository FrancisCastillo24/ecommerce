<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductVariants extends Component
{

    public $product;

    public $openModal = true;

    public $options;

    public $variant = [
        'option_id' => '',
        'features' => [
            [
                'id' => '',
                'value' => '',
                'description' => ''
            ],
        ]
    ];

    public function mount()
    {
        $this->options = Option::all();
    }

    public function updateVariantOptionId()
    {
        $this->variant['features'] = [
            [
                'id' => '',
                'value' => '',
                'description' => ''
            ],
        ];
    }

    #[Computed()]
    public function features()
    {
        // En el formulario eligo option_id = 3 (color) pues devuelve todos los features de esa option_id (rojo, negro, azul)
        return Feature::where('option_id', $this->variant['option_id'])->get();
    }

    public function addFeature()
    {
        $this->variant['features'][] = [
            'id' => '',
            'value' => '',
            'description' => ''
        ];
    }

    public function feature_change($index)
    {
        $feature = Feature::find($this->variant['features'][$index]['id']);

        if ($feature) {
            $this->variant['features'][$index]['value'] = $feature->value;
            $this->variant['features'][$index]['description'] = $feature->description;
        }
    }

    // Borramos los valores y creamos un nuevo array
    public function removeFeature($index)
    {
        unset($this->variant['features'][$index]);
        $this->variant['features'] = array_values($this->variant['features']);
    }

    public function save()
    {
        $this->validate([
            'variant.option_id' => 'required',
            'variant.features.*.id' => 'required',
            'variant.features.*.value' => 'required',
            'variant.features.*.description' => 'required',
        ]);
        // Relaciones
        $this->product->options()->attach(
            $this->variant['option_id'],
            [
                'features' => $this->variant['features']
            ]
        );

        $this->reset(['variant', 'openModal']);
    }

    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }
}
