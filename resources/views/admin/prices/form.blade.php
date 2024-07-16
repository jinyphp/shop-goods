<x-navtab class="mb-3 nav-bordered">
    <!-- formTab(detault) -->
    <x-navtab-item class="show active" >
        <x-navtab-link class="rounded-0 active">
            <span class="d-none d-md-block">기본정보</span>
        </x-navtab-link>

        <div class="mb-3 row">
            <label class="col-form-label col-sm-2 text-sm-end">활성화</label>
            <div class="col-sm-10 d-flex align-items-center gap-2">
                {!! xCheckbox()
                    ->setWire('model.defer',"forms.enable")
                !!}
            </div>
        </div>


        <div class="mb-3 row">
            <label class="col-form-label col-sm-2 text-sm-end">상품</label>
            <div class="col-sm-10 d-flex align-items-center gap-2">
                <input type="text" class="form-control"
                    wire:model.defer="forms.goods"
                    wire:keydown.enter="searchGoodsEnter($event.target.value)">

                <div wire:click="resetForm('goods')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </div>

            </div>
        </div>
        @if($popupSearchGoods)
            <!-- 상품검색 팝업-->
            <x-wire-dialog-modal wire:model="popupSearchGoods" maxWidth="xl" >
                <x-slot name="title">
                    {{__('상품선택')}}
                </x-slot>

                <x-slot name="content">
                    <table class="w-100">
                    @foreach($searchGoodRows as $i => $item)
                        <tr>
                            <td width="50px">
                                <img src="/{{$item['image']}}" width="100%">
                            </td>
                            <td>
                                <x-click wire:click="popupSearchGoodSelect({{$i}})">
                                {{$item['name']}}
                                </x-click>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </x-slot>

                <x-slot name="footer">
                    <div class="flex justify-between">
                        <div></div>
                        <div class="text-right">
                            <x-btn-second wire:click="popupSearchGoodsClose">닫기</x-btn-second>
                        </div>
                    </div>
                </x-slot>
            </x-x-wire-dialog-modal>
        @endif



        <div class="mb-3 row">
            <label class="col-form-label col-sm-2 text-sm-end">가격유형</label>
            <div class="col-sm-10 d-flex align-items-center gap-2">
                {!! xSelect()
                    ->table('shop_price_type','name')
                    ->setWire('model.defer',"forms.type")
                    ->setWidth("medium")
                !!}
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-form-label col-sm-2 text-sm-end">가격</label>
            <div class="col-sm-10 d-flex align-items-center gap-2">
                {!! xInputText()
                    ->setWire('model.defer',"forms.price")
                    ->setWidth("standard")
                !!}
            </div>
        </div>

    </x-navtab-item>

    <!-- formTab(others) -->
    <x-navtab-item class="" >
        <x-navtab-link class="rounded-0">
            <span class="d-none d-md-block">상세정보</span>
        </x-navtab-link>

        <x-form-hor>
            <x-form-label>담당자</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.manager")
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
