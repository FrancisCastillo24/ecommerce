<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    // Con esta librería, la aplicación está lista para subir imágenes
    use WithFileUploads;

    // Recibimos el producto que queremos editar
    public $product;

    // Almacenamos todos los campos
    public $productEdit;

    // Defino las siguientes propiedad para mostrar en la vista
    public $families;
    public $family_id = '';
    public $category_id = '';
    public $image;

    public function mount($product)
    {
        // En la propiedad edit, almacenamos todos los datos del producto seleccionado pero con los siguientes campos
        $this->productEdit = $product->only('sku', 'name', 'description', 'price', 'stock', 'image_path', 'subcategory_id');
        // dd($this->productEdit);

        // Vamos a recuperar todas las familias
        $this->families = Family::all();

        // Almaceno el id de la categoría a la que pertenece la subcategoría de ese producto
        $this->category_id = $product->subcategory->category->id;

        // Almaceno el id de la familia a la que pertenece el producto
        $this->family_id = $product->subcategory->category->family_id;
    }

    // Función para verificar si hay error de validación o mostrar alerts
    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {

                $this->dispatch('swal', [
                    'icon' => 'success',
                    'title' => '¡Error!',
                    'text' => 'El formulario contiene errores.',
                ]);
            }
        });
    }

    // Si se modifica campo family_id, el campo family_id retorna vacío, y luego el campo subcategory sale vacío
    public function updatedFamilyId($value)
    {
        $this->category_id = '';
        $this->productEdit['subcategory_id'] = '';
    }

    // Método para que al seleccionar una categoría nueva, la subcategoría se limpia
    public function updatedCategoryId($value)
    {
        $this->productEdit['subcategory_id'] = '';
    }

    #[On('variant-generate')]
    public function updateProduct()
    {
        $this->product = $this->product->fresh();
    }

    // Nos va a retornar todas las categorías dependiendo de lo que hayamos seleccionado en campo family_id
    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->family_id)->get();
    }

    // Nos va a retornar todas las subcategorias dependiendo de lo que hayamos seleccionado en el campo category
    #[Computed()]
    public function subcategories()
    {
        return Subcategory::where('category_id', $this->category_id)->get();
    }

    public function store()
    {
        // Validamos los datos del formulario de edición
        $this->validate([
            'image' => 'nullable|image|max:1024',
            'productEdit.sku' => 'required|unique:products,sku,' . $this->product->id, // Ponemos esto para que el sku sea único pero cuando se modifique, éste se mantenga
            'productEdit.name' => 'required|max:255',
            'productEdit.description' => 'nullable',
            'productEdit.price' => 'required|numeric|min:0',
            'productEdit.stock' => 'required|numeric|min:0',
            'productEdit.subcategory_id' => 'required|exists:subcategories,id',
        ]);

        // Condición para comprobar si hemos seleccionado alguna imagen
        if ($this->image) {

            // Eliminamos la foto actual pasandole el path donde se encuentra la imagen
            Storage::delete($this->productEdit['image_path']);

            // Subimos la imagen nueva al servidor (carpeta llamada products)
            $this->productEdit['image_path'] = $this->image->store('products');
        }

        // Actualizamos el producto
        $this->product->update($this->productEdit);

        // Mensajes de éxito y redireccionamos con el producto ya modificado, en lugar de recargar la página.
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'Producto actualizado correctamente.'
        ]);


        return redirect()->route('admin.products.edit', $this->product);
    }
    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
