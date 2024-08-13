<button type="button" class="btn btn-icon btn-lg"
    wire:click="decreaseQuantity()">
    <i class="ci-minus"></i>
</button>
<input type="number" class="form-control form-control-lg" wire:model="qty">
<button type="button" class="btn btn-icon btn-lg"
    wire:click="increaseQuantity()">
    <i class="ci-plus"></i>
</button>
