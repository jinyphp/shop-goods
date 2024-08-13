<div>
    <!-- Count input + Add to cart button -->
    <div class="d-flex gap-3 pb-3 pb-lg-4 mb-3">
        <div class="count-input flex-shrink-0">
            @includeIf('jiny-shop-goods::detail_v2.info.quantity', [])
        </div>

        <div class="align-text-bottom">
        </div>

    </div>

    <!-- Count input + Add to cart button -->
    <div class="d-flex gap-3 pb-3 pb-lg-4 mb-3">

        <div class="flex-shrink-0">
            <button type="button"
                class="btn btn-lg btn-secondary w-100"
                wire:click="wish()">
                Wish
            </button>
        </div>
        <button type="button" class="btn btn-lg btn-dark w-100"
            wire:click="addCart()">
            Add to cart
        </button>

        <div class="flex-shrink-0">
            <button type="button" class="btn btn-lg btn-primary w-100"
                wire:click="orderNow()">
                Order Now
            </button>
        </div>
    </div>

    @if (session('detail_message'))
    <div class="alert alert-success">
        {{ session('detail_message') }}
    </div>
    @endif


    <!-- Info list -->
    @includeIf('jiny-shop-goods::detail_v2.info.delivery', [])

    <!-- Stock status -->
    @includeIf('jiny-shop-goods::detail_v2.info.stock', [])
</div>

