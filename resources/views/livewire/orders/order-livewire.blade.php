<div class="d-flex justify-content-between align-items-between">

    <!-- Column 8 Right -->
    <div class="col-md-8">
        <div class="card">
            {{-- <div class="card-header">
                <input type="text" wire:model.defer="search" placeholder="Search orders..." class="form-control mb-3" />
                <button wire:click="searchOrders" class="btn btn-primary">Search</button>
            </div> --}}
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>client name</th>
                                <th>phone number</th>
                                <th>final price</th>
                                <th>quantity</th>
                                <th>product id</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders) > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->client_name }}</td>
                                        <td>{{ $order->phone_number }}</td>
                                        <td>{{ $order->final_price }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->product->product_name }}</td>
                                        <td>
                                            <button wire:click="edit({{ $order->id }})"
                                                class="btn btn-primary btn-sm">Edit</button>
                                            <button wire:click="confirmDelete({{ $order->id }})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">No Orders Found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{-- {{ $orders->links() }} --}}

                </div>
            </div>
            <div class="card-footer">
                @if($confirmingDelete == $order->id)
                <div>
                    Are you sure you want to delete this order?
                    <button wire:click="destroy" class="btn btn-danger btn-sm">Yes, Delete</button>
                    <button wire:click="$set('confirmingDelete', null)" class="btn btn-secondary btn-sm">Cancel</button>
                </div>
            @endif
            </div>
        </div>
    </div>
    <!-- Column 4 Left -->
    <div class="col-md-4 mb-2">
        <div class="card">
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if ($updateOrder)
                    @include('livewire.orders.update')
                @else
                    @include('livewire.orders.create')
                @endif
                
            </div>
        </div>
    </div>

    {{-- <script>
        function deleteOrder(id) {

            if (confirm(`zzzzzzzzzzzzzzzzzz ${id}`))
                window.livewire.emit('deleteOrder', id);
        }
    </script> --}}
</div>
