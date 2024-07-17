<div>
    @includeIf('jiny-shop-goods::products.control')



    <!-- 상품진열 -->
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <a href="/shop/detail/{{$product->id}}">
                        <img src="/{{$product->image}}"
                            class="card-img-top">
                        </a>


                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <a href="/shop/detail/{{$product->id}}"
                                    class="fw-bolder">
                                    {{$product->name}}
                                </a>
                                {{$product->author}} / {{$product->translator}}

                                <!-- Product price-->
                                $40.00 - $80.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>

                            {{-- 로그인 상태만 관심상품 추가 --}}
                            @auth
                            <div wire:click="addWish('{{$product->id}}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- END Products -->

    <div class="wrap-pagination-info">
        {{$products->links()}}
    </div>




    {{-- <x-popup-dialog maxWidth="4xl" wire:model="popupCart">
        <x-slot name="title">
            {{ __('장바구니 추가') }}
        </x-slot>
        <x-slot name="content">
            선택하신 상품이 장바구니에 추가 되었습니다.
        </x-slot>
        <x-slot name="footer">

            <x-btn-primary wire:click="popupCartClose">닫기</x-btn-primary>
        </x-slot>
    </x-popup-dialog> --}}
</div>
