<!-- Product gallery -->
<div class="col-md-5">

    <!-- Preview (Large image) -->
    <div class="swiper" data-swiper='{
    "loop": true,
    "navigation": {
        "prevEl": ".btn-prev",
        "nextEl": ".btn-next"
    },
    "thumbs": {
        "swiper": "#thumbs"
    }
    }'>
    <div class="swiper-wrapper">

        @foreach($product as $image)
            <div class="swiper-slide">
                <div class="ratio ratio-1x1">
                    <img src={{$image['image']}} data-zoom={{$image['image']}} data-zoom-options='{
                    "paneSelector": "#zoomPane",
                    "inlinePane": 768,
                    "hoverDelay": 500,
                    "touchDisable": true
                    }' alt="Preview">
                </div>
            </div>
        @endforeach
    </div>

    <!-- Prev button -->
    <div class="position-absolute top-50 start-0 z-2 translate-middle-y ms-sm-2 ms-lg-3">
        <button type="button" class="btn btn-prev btn-icon btn-outline-secondary bg-body rounded-circle animate-slide-start" aria-label="Prev">
        <i class="ci-chevron-left fs-lg animate-target"></i>
        </button>
    </div>

    <!-- Next button -->
    <div class="position-absolute top-50 end-0 z-2 translate-middle-y me-sm-2 me-lg-3">
        <button type="button" class="btn btn-next btn-icon btn-outline-secondary bg-body rounded-circle animate-slide-end" aria-label="Next">
        <i class="ci-chevron-right fs-lg animate-target"></i>
        </button>
    </div>
    </div>

    <!-- Thumbnails -->
    <div class="swiper swiper-load swiper-thumbs pt-2 mt-1" id="thumbs" data-swiper='{
    "loop": true,
    "spaceBetween": 12,
    "slidesPerView": 3,
    "watchSlidesProgress": true,
    "breakpoints": {
        "340": {
        "slidesPerView": 4
        },
        "500": {
        "slidesPerView": 5
        },
        "600": {
        "slidesPerView": 6
        },
        "768": {
        "slidesPerView": 4
        },
        "992": {
        "slidesPerView": 5
        },
        "1200": {
        "slidesPerView": 6
        }
    }
    }'>
        <div class="swiper-wrapper">

            @foreach($product as $image)
                <div class="swiper-slide swiper-thumb">
                    <div class="ratio ratio-1x1" style="max-width: 94px">
                        <img src={{$image['image']}} class="swiper-thumb-img" alt="Thumbnail">
                    </div>
                </div>
            @endforeach

        </div>


        <!-- Image Slider 등록-->
        {{-- <x-flex class="gap-2">
            <h1 class="h3">
                상품 이미지
            </h1>
            <div>
                <x-click wire:click="modify()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                </x-click>
            </div>
        </x-flex>

        @livewire('shop-product-slider-upload-drag') --}}
    </div>
</div>
