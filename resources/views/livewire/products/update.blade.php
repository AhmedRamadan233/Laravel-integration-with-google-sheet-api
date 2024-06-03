<form>
    <input type="hidden" wire:model="product_id">
    <div class="form-group mb-3">
        <label for="product_name">product_name:</label>
        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" placeholder="Enter product_name" wire:model="product_name">
        @error('product_name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="country">country:</label>
        <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" placeholder="Enter country" wire:model="country">
        @error('country') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="product_code">product_code:</label>
        <input type="text" class="form-control @error('product_code') is-invalid @enderror" id="product_code" placeholder="Enter product_code" wire:model="product_code">
        @error('product_code') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="description">description:</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter description" wire:model="description">
        @error('description') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    
    <div class="d-grid gap-2">
        <button wire:click.prevent="update()" class="btn btn-success btn-block">Save</button>
        <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
    </div>
</form>
