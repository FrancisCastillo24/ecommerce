<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductCreate extends Component
{
    // Defino una propiedad de producto y de la familia
    public $families;
    public $family_id = '';
    public $category_idº = '';
    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'price' => '',
        'subcategory_id' => '',
    ];

    // Pido que me retorne la lista familia
    public function mount()
    {
        $this->families = Family::all();
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id, $this->family_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
