<x-navtab class="mb-3 nav-bordered">
    <!-- formTab(detault) -->
    <x-navtab-item class="show active">
        <x-navtab-link class="rounded-0 active">
            <span class="d-none d-md-block">상품정보</span>
        </x-navtab-link>

        <x-form-hor>
            <x-form-label>활성화</x-form-label>
            <x-form-item>
                {!! xCheckbox()
                    ->setWire('model.defer',"forms.enable")
                !!}
            </x-form-item>
        </x-form-hor>

        {{-- <x-form-hor>
            <x-form-label>category_id</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.category_id")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor> --}}
        <x-form-hor>
            <x-form-label>카테고리</x-form-label>
            <x-form-item>
                {!! xSelect()
                    ->table('shop_categories','name')
                    ->setWire('model.defer',"forms.category_id")
                    ->setWidth("medium")
                !!}

            </x-form-item>
        </x-form-hor>


        <x-form-hor>
            <x-form-label>상품명</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.name")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        {{-- <x-form-hor>
            <x-form-label>image</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.image")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor> --}}
        <div class="mb-3">
            <label for="simpleinput" class="form-label">사진</label>
            <input type="file" class="form-control"
                        wire:model.defer="forms.image">
            @if(isset($forms['image']))
            <div class="p-2">파일명: /{{$forms['image']}}</div>
            <img src="/{{$forms['image']}}" width="300px" alt="">
            @endif
        </div>
    </x-navtab-item>


    <!-- formTab(others) -->
    <x-navtab-item class="" >
        <x-navtab-link class="rounded-0">
            <span class="d-none d-md-block">제품정보</span>
        </x-navtab-link>

        <x-form-hor>
            <x-form-label>slug</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.slug")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>



        <x-form-hor>
            <x-form-label>regular_price</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.regular_price")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>sale_price</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.sale_price")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>SKU</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.SKU")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>stock_status</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.stock_status")
                    ->setWidth("standard")
                !!}
                'instock','soldout'
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>featured'</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.featured")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>


        <x-form-hor>
            <x-form-label>재고수량</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.quantity")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>



        <x-form-hor>
            <x-form-label>option</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.option")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>shipping_free</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.shipping_free")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>author</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.author")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>translator</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.translator")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>
    </x-navtab-item>

    <x-navtab-item class="" >
        <x-navtab-link class="rounded-0">
            <span class="d-none d-md-block">상품설명</span>
        </x-navtab-link>

        <x-form-hor>
            <x-form-label>간략 설명</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.short_description")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>상세설명</x-form-label>
            <x-form-item>
                {!! xTextarea()
                    ->setWire('model.defer',"forms.description")
                !!}
            </x-form-item>
        </x-form-hor>

    </x-navtab-item>
</x-navtab>
