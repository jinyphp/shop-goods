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

    <div class="d-flex justify-content-center" style="height: 100vh;">
        <!-- 상품 상세정보 -->

        @livewire('ShopProductInformation', [
            'product'=>$product
        ])
    </div>

</div>
</x-www-layout>
