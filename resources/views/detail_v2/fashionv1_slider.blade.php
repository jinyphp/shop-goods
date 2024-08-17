<!-- Gallery -->
<div class="col-md-6 pb-4 pb-md-0 mb-2 mb-sm-3 mb-md-0">
    <div class="position-relative">
        <span
            class="badge text-bg-danger position-absolute top-0 start-0 z-2 mt-3 mt-sm-4 ms-3 ms-sm-4">Sale</span>
        <button type="button"
            class="btn btn-icon btn-secondary animate-pulse fs-lg bg-transparent border-0 position-absolute top-0 end-0 z-2 mt-2 mt-sm-3 me-2 me-sm-3"
            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm"
            data-bs-title="Add to Wishlist" aria-label="Add to Wishlist">
            <i class="ci-heart animate-target"></i>
        </button>
        <a class="hover-effect-scale hover-effect-opacity position-relative d-flex rounded overflow-hidden mb-3 mb-sm-4 mb-md-3 mb-lg-4"
            href={{$product[0]}} data-glightbox data-gallery="product-gallery">
            <i
                class="ci-zoom-in hover-effect-target fs-3 text-white position-absolute top-50 start-50 translate-middle opacity-0 z-2"></i>
            <div class="ratio hover-effect-target bg-body-tertiary rounded"
                style="--cz-aspect-ratio: calc(706 / 636 * 100%)">
                <img src={{$product[0]}} alt="Image">
            </div>
        </a>
    </div>
    <div class="collapse d-md-block" id="morePictures">
        <div class="row row-cols-2 g-3 g-sm-4 g-md-3 g-lg-4 pb-3 pb-sm-4 pb-md-0">

            @for($i = 1; $i <= 4; $i++)
                @if ($i >= count($product))
                    @continue
                @endif
                <div class="col">

                    @if($popupForm)
                        <div class="hover-effect-scale hover-effect-opacity position-relative d-flex rounded overflow-hidden"
                        wire:click="RemoveSliderImage({{$product[$i]['id']}})">
                            <i class="ci-close-circle hover-effect-target fs-3 text-white position-absolute top-50 start-50 translate-middle opacity-0 z-2"></i>
                            <div class="ratio hover-effect-target bg-body-tertiary rounded"
                                style="--cz-aspect-ratio: calc(342 / 306 * 100%)">
                                <img src="{{ $product[$i]['image'] }}" alt="Image">
                            </div>
                        </div>

                    @else
                        <a class="hover-effect-scale hover-effect-opacity position-relative d-flex rounded overflow-hidden"
                        href={{$product[$i]['image']}} data-glightbox
                        data-gallery="product-gallery">
                            <i class="ci-zoom-in hover-effect-target fs-3 text-white position-absolute top-50 start-50 translate-middle opacity-0 z-2"></i>
                            <div class="ratio hover-effect-target bg-body-tertiary rounded"
                                style="--cz-aspect-ratio: calc(342 / 306 * 100%)">
                                <img src={{$product[$i]['image']}} alt="Image">
                            </div>
                        </a>
                    @endif
                </div>
            @endfor
        </div>
    </div>
    <button type="button" class="btn btn-lg btn-outline-secondary w-100 collapsed d-md-none"
        data-bs-toggle="collapse" data-bs-target="#morePictures" data-label-collapsed="Show more pictures"
        data-label-expanded="Show less pictures" aria-expanded="false" aria-controls="morePictures"
        aria-label="Show / hide pictures">
        <i class="collapse-toggle-icon ci-chevron-down fs-lg ms-2 me-n2"></i>
    </button>
    <!-- Image Slider 등록-->
    <x-flex class="gap-2">
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

    @livewire('shop-product-slider-upload-drag')
    @if ($popupForm)
        <button class="btn btn-primary" wire:click="update">수정완료</button>
    @endif

</div>
