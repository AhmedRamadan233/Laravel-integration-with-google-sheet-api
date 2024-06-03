<form>
    <input type="hidden" wire:model="order_id">
    <div class="form-group mb-3">
        <label for="client_name">client_name:</label>
        <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" placeholder="Enter client_name" wire:model="client_name">
        @error('client_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="phone_number">phone_number:</label>
        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="Enter phone_number" wire:model="phone_number">
        @error('phone_number') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="product_id">Product:</label>
        <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" wire:model="product_id">
            <option value="">Select a Product</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
            @endforeach
        </select>
        @error('product_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    
    <div class="form-group mb-3">
        <label for="final_price">final_price:</label>
        <input type="text" class="form-control @error('final_price') is-invalid @enderror" id="final_price" placeholder="Enter final_price" wire:model="final_price">
        @error('final_price') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="quantity">quantity:</label>
        <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="Enter quantity" wire:model="quantity">
        @error('quantity') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    
    <div class="d-grid gap-2">
        <button wire:click.prevent="update()" class="btn btn-success btn-block">Save</button>
        <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
    </div>
</form>
