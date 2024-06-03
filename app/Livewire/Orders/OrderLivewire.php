<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class OrderLivewire extends Component
{
    use WithPagination;

    public $products, $orders, $client_name, $phone_number, $product_id,  $final_price, $quantity, $order_id;
    public $updateOrder = false;
    public $search = '';
    public $confirmingDelete = null;

    protected $listeners = [
        'deleteOrder' => 'destroy'
    ];
    // Validation Rules
    protected $rules = [
        'client_name' => 'required',
        'phone_number' => 'required',
        'product_id' => 'required',
        'final_price' => 'required',
        'quantity' => 'required',
    ];
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        // Adjusted query to handle search correctly
        $this->orders = Order::with('product')
            ->where(function ($query) {
                $query->where('client_name', 'like', '%' . $this->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $this->search . '%');
            })
            ->get();

        $this->products = Product::select('id', 'product_name')->get();

        return view('livewire.orders.order-livewire', [
            'orders' => $this->orders,
            'products' => $this->products,
        ]);
    }
    public function resetFields()
    {
        $this->client_name = '';
        $this->phone_number = '';
        $this->product_id = '';
        $this->final_price = '';
        $this->quantity = '';
    }
    public function store()
    {
        // Validate Form Request
        $this->validate();
        try {
            // Create Product
            Order::create([
                'client_name' => $this->client_name,
                'phone_number' => $this->phone_number,
                'product_id' => $this->product_id,
                'final_price' => $this->final_price,
                'quantity' => $this->quantity,
            ]);

            // Set Flash Message
            session()->flash('success', 'Order Created Successfully!!');
            // Reset Form Fields After Creating Order
            $this->resetFields();
        } catch (\Exception $e) {
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating Order!!');
            // Reset Form Fields After Creating Order
            $this->resetFields();
        }
    }
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $this->client_name = $order->client_name;
        $this->phone_number = $order->phone_number;
        $this->product_id = $order->product_id;
        $this->final_price = $order->final_price;
        $this->quantity = $order->quantity;
        $this->order_id = $order->id;
        $this->updateOrder = true;
    }
    public function cancel()
    {
        $this->updateOrder = false;
        $this->resetFields();
    }
    public function update()
    {
        // Validate request
        $this->validate();
        try {
            // Update category
            Order::find($this->order_id)->fill([
                'client_name' => $this->client_name,
                'phone_number' => $this->phone_number,
                'final_price' => $this->final_price,
                'product_id' => $this->product_id,
                'quantity' => $this->quantity
            ])->save();
            session()->flash('success', 'Order Updated Successfully!!');

            $this->cancel();
        } catch (\Exception $e) {
            session()->flash('error', 'Something goes wrong while updating Order!!');
            $this->cancel();
        }
    }
    public function confirmDelete($id)
    {
        $this->confirmingDelete = $id;
    }
    public function searchOrders()
    {
        $this->orders = Order::where('client_name', 'like', '%' . $this->search . '%')
            ->orWhere('phone_number', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function destroy()
    {
        if ($this->confirmingDelete) {
            try {
                Order::find($this->confirmingDelete)->delete();
                session()->flash('success', "Order Deleted Successfully!!");
                $this->confirmingDelete = null;
            } catch (\Exception $e) {
                session()->flash('error', "Something goes wrong while deleting Order!!");
                $this->confirmingDelete = null;
            }
        }
    }
}
