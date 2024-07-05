<x-www-layout>
<div class="row">
    <div class="col-6">
        <!-- 상품이미지 슬라이더 -->
        @livewire('ShopProductSlider', [
            'product' => $product
        ])

    </div>

    <div class="col-6">
        <!-- 구매정보 -->
        @livewire('ShopProductDetail',[
            'slug'=>$slug,
            'cartidx'=>$cartidx,
            'admin'=>$admin
        ])
    </div>
</div>
</x-www-layout>
