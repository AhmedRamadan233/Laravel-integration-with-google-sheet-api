<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class ProductLivewire extends Component
{

    public $products, $product_name, $country, $product_code,  $description, $product_id;
    public $updateProduct = false;
    protected $listeners = [
        'deleteProduct' => 'destroy'
    ];
    // Validation Rules
    protected $rules = [
        'product_name' => 'required',
        'description' => 'required',
        'country' => 'required',
        'product_code' => 'required',
    ];
    public function render()
    {
        $this->products = Product::select('id', 'product_name', 'country', 'product_code', 'description')->get();
        return view('livewire.products.product-livewire');
    }
    public function resetFields()
    {
        $this->product_name = '';
        $this->country = '';
        $this->product_code = '';
        $this->description = '';
    }
    public function store()
    {
        // Validate Form Request
        $this->validate();
        try {
            // Create Product
            Product::create([
                'product_name' => $this->product_name,
                'country' => $this->country,
                'product_code' => $this->product_code,
                'description' => $this->description,
            ]);

            // Set Flash Message
            session()->flash('success', 'Product Created Successfully!!');
            // Reset Form Fields After Creating Product
            $this->resetFields();
        } catch (\Exception $e) {
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating Product!!');
            // Reset Form Fields After Creating Product
            $this->resetFields();
        }
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_name = $product->product_name;
        $this->product_code = $product->product_code;
        $this->country = $product->country;
        $this->description = $product->description;
        $this->product_id = $product->id;
        $this->updateProduct = true;
    }
    public function cancel()
    {
        $this->updateProduct = false;
        $this->resetFields();
    }
    public function update()
    {
        // Validate request
        $this->validate();
        try {
            // Update category
            Product::find($this->product_id)->fill([
                'product_name' => $this->product_name,
                'product_code' => $this->product_code,
                'country' => $this->country,
                'description' => $this->description
            ])->save();
            session()->flash('success', 'Product Updated Successfully!!');

            $this->cancel();
        } catch (\Exception $e) {
            session()->flash('error', 'Something goes wrong while updating Product!!');
            $this->cancel();
        }
    }
    public function destroy($id)
    {
        try {
            Product::find($id)->delete();
            session()->flash('success', "Product Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong while deleting Product!!");
        }
    }
}
