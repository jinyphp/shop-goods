<div>
    @includeIf('jiny-shop-goods::products.control')

    <!-- Products -->
    <div class="grid grid-cols-1 gap-4 lg:gap-8">
        @foreach ($products as $product)

        <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
            <div class="p-5 lg:p-6 grow w-full flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-6">
                <div class="flex-none md:w-64">
                    <a href="/shop/detail/{{$product->id}}">
                        <img src="{{ asset($product->image) }}" alt="Product Image" class="rounded-lg">
                    </a>
                </div>

                <div class="grow">
                    <div class="uppercase text-blue-600 tracking-wide text-sm font-semibold">
                    Wearables
                    </div>
                    <a href="/shop/detail/{{$product->id}}"
                        class="block font-semibold md:text-lg text-gray-600 hover:text-gray-500">
                        {{$product->name}}
                    </a>
                    <div class="text-orange-500">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="hi-solid hi-star inline-block w-5 h-5"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="hi-solid hi-star inline-block w-5 h-5"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="hi-solid hi-star inline-block w-5 h-5"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="hi-solid hi-star inline-block w-5 h-5"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="hi-solid hi-star inline-block w-5 h-5"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="leading-relaxed text-gray-600 mt-2">
                        {{$product->short_description}}
                    </p>
                </div>
                <div class="flex-none md:w-48 space-y-4">
                    <div class="flex items-center justify-center space-x-2 p-3 bg-gray-100 rounded-lg">
                        <button type="button" class="h-5 w-5 rounded-full shadow-inner inline-block hover:opacity-75 active:opacity-100 focus:outline-none bg-gray-400 focus:ring focus:ring-gray-400 focus:ring-opacity-50"></button>
                        <button type="button" class="h-5 w-5 rounded-full shadow-inner inline-block hover:opacity-75 active:opacity-100 focus:outline-none bg-red-400 focus:ring focus:ring-red-400 focus:ring-opacity-50"></button>
                        <button type="button" class="h-5 w-5 rounded-full shadow-inner inline-block hover:opacity-75 active:opacity-100 focus:outline-none bg-purple-400 focus:ring focus:ring-purple-400 focus:ring-opacity-50"></button>
                        <button type="button" class="h-5 w-5 rounded-full shadow-inner inline-block hover:opacity-75 active:opacity-100 focus:outline-none bg-black focus:ring focus:ring-black focus:ring-opacity-50"></button>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="text-gray-600 font-medium">
                            ${{$product->regular_price}}
                        </div>
                    <div class="inline-flex items-center">
                        <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-transparent text-gray-600 hover:text-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:text-gray-600">
                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="hi-solid hi-minus-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                        </button>
                        <span class="px-2">1</span>
                        <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-2 py-1 leading-5 text-sm rounded border-transparent text-gray-600 hover:text-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:text-gray-600">
                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="hi-solid hi-plus-circle inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                    </div>
                    <div class="flex flex-col">
                        <button type="button"
                        wire:click.prevent="addCart({{$product->id}}, '{{$product->name}}', {{$product->regular_price}})"
                        class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-shopping-bag inline-block w-5 h-5"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
                            <span>장바구니</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

          {{--
        <div class="flex flex-col justify-between">
            <div class="group relative overflow-hidden mb-2">
                <a href="/shop/detail/{{$product->id}}">
                    <img src="{{ asset($product->image) }}" class="object-fill" alt="Product Image">
                </a>

            </div>
            <div>
                <a href="/shop/detail/{{$product->id}}" class="block font-semibold text-gray-600 hover:text-gray-500">
                    {{$product->name}}
                </a>
                <div class="text-gray-500 font-medium">
                    ${{$product->regular_price}}
                </div>
                <a href="#" class="btn add-to-cart"
                    wire:click.prevent="addCart({{$product->id}}, '{{$product->name}}', {{$product->regular_price}})">
                    장바구니
                </a>
            </div>
        </div>
        --}}
        @endforeach

    </div>
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
