<div class="d-flex justify-content-between align-items-between">

    <!-- Column 8 Right -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>product_name</th>
                                <th>product_code</th>
                                <th>country</th>
                                <th>description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($products) > 0)
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->country }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            <button wire:click="edit({{ $product->id }})"
                                                class="btn btn-primary btn-sm">Edit</button>
                                            <button onclick="deleteProdect({{ $product->id }})"
                                                class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">No Products Found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
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
                @if ($updateProduct)
                    @include('livewire.products.update')
                @else
                    @include('livewire.products.create')
                @endif
            </div>
        </div>
    </div>

    <script>
        function deleteProduct(id) {

            if (confirm(`zzzzzzzzzzzzzzzzzz ${id}`))
                window.livewire.emit('deleteProduct', id);
        }
    </script>
</div>
