@push('css')
    <style>
        .pl-4, .px-4 {
            padding-left: 1.5rem !important
        }

        .pb-2, .py-2 {
            padding-bottom: .5rem !important
        }
        .pt-2, .py-2 {
            padding-top: .5rem !important
        }
        .bg-white {
            background-color: #fff !important
        }
        .border {
            border: 1px solid #dee2e6 !important
        }
        nav svg {
            height: 20px;
        }
        svg {
            overflow: hidden
            vertical-align:middle;
        }
        .wrap-pagination-info {
            margin-top:46px;
            border-top: 1px solid #e6e6e6;
            padding-top:10px;
        }
        .wrap-pagination-info .hidden {
            display: block !important
        }
        .wrap-pagination-info .rounded-l-md {
            margin-right:5px;
        }
        .wrap-pagination-info .rounded-r-md {
            margin-left:5px;
        }
    </style>
@endpush

<x-www-layout>





    {{-- 카테고리 Hero--}}
    {{-- @livewire('WidgetCategoryHero',['cate'=>$cate ,'admin'=>$admin]) --}}



    <!--main area-->
    {{-- id="main" class="main-site left-sidebar" --}}
    <main class="mx-auto" style="width:1280px;">
        <div class="flex justify-between items-start ">

            <div class="w-64 pr-8 mr-8 " style="width:264px">

                <h5>카테고리</h2>
                <!-- 카테고리 리스트 -->
                @livewire('shop-category', [
                'category' => "shop",
                'widget' =>[
                    'view' =>[
                        'list' => "jiny-shop-goods::category.widget.list",
                        'item' => "jiny-shop-goods::category.widget.item"
                    ]
                ]
                ])


                {{-- @livewire('Category',['code_id'=>1, 'slug'=>$slug]) --}}

                {{--
                <!-- 사이드 카테고리 -->
                @include('shop::shop.category.sidebar')

                <!-- Popular Products -->
                @livewire('ShopPopularProducts')
                --}}

            </div>
            <div class="flex-1">
                <!-- breadcrumb -->
                @livewire('shop-category-breadcrumb',[
                    'category' => "shop",
                    'item' => "텔레비젼"
                ])

                <!-- 많이 찾으시는 브랜드 -->
                @livewire('shop-brand')


                {{-- 카테고리 베너 이미지 --}}
                {{--
                <div class="banner-shop">
                    <a href="#" class="banner-link">
                        <figure>
                            <img src="{{ asset('assets/shop/templates/images/shop-banner.jpg') }}" alt="">
                        </figure>
                    </a>
                </div>
                --}}


                @if($cate)
                    <div>카테고리</div>
                    @livewire('shop-product-list',[
                        'cate'=>$cate,
                        'category_id'=>$cate['id'],
                        'cartidx'=>$cartidx
                    ])
                @else
                    <p>전체목록</p>
                    @livewire('shop-product-list',[
                        'category_id'=>null,
                        'cartidx'=>$cartidx
                    ])
                @endif

                {{-- drag 상품등록 --}}
                @if($admin)
                    @livewire('shop-product-upload-drag')
                @endif

            </div>

        </div>
    </main>
    <!--main area-->
</x-www-layout>
