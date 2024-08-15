<!-- Product gallery -->
<div class="col-md-6">

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
                    <img src={{$image}} data-zoom={{$image}} data-zoom-options='{
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
                        <img src={{$image}} class="swiper-thumb-img" alt="Thumbnail">
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</div>
