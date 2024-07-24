<!-- Reviews -->
<div>
    <div class="d-flex align-items-center pt-5 mb-4 mt-2 mt-md-3 mt-lg-4" id="reviews" style="scroll-margin-top: 80px">
        <h2 class="h3 mb-0">Reviews</h2>
        <button type="button" class="btn btn-secondary ms-auto" data-bs-toggle="modal" data-bs-target="#reviewForm">
          <i class="ci-edit-3 fs-base ms-n1 me-2"></i>
          Leave a review
        </button>
    </div>

    <!-- Reviews stats -->
    <div class="row g-4 pb-3">
    <div class="col-sm-4">

        <!-- Overall rating card -->
        <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-body-tertiary rounded p-4">
        <div class="h1 pb-2 mb-1">4.1</div>
        <div class="hstack justify-content-center gap-1 fs-sm mb-2">
            <i class="ci-star-filled text-warning"></i>
            <i class="ci-star-filled text-warning"></i>
            <i class="ci-star-filled text-warning"></i>
            <i class="ci-star-filled text-warning"></i>
            <i class="ci-star text-body-tertiary opacity-60"></i>
        </div>
        <div class="fs-sm">68 reviews</div>
        </div>
    </div>
    <div class="col-sm-8">

        <!-- Rating breakdown by quantity -->
        <div class="vstack gap-3">

        <!-- 5 stars -->
        <div class="hstack gap-2">
            <div class="hstack fs-sm gap-1">
            5<i class="ci-star-filled text-warning"></i>
            </div>
            <div class="progress w-100" role="progressbar" aria-label="Five stars" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
            <div class="progress-bar bg-warning rounded-pill" style="width: 54%"></div>
            </div>
            <div class="fs-sm text-nowrap text-end" style="width: 40px;">37</div>
        </div>

        <!-- 4 stars -->
        <div class="hstack gap-2">
            <div class="hstack fs-sm gap-1">
            4<i class="ci-star-filled text-warning"></i>
            </div>
            <div class="progress w-100" role="progressbar" aria-label="Four stars" aria-valuenow="23.5" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
            <div class="progress-bar bg-warning rounded-pill" style="width: 23.5%"></div>
            </div>
            <div class="fs-sm text-nowrap text-end" style="width: 40px;">16</div>
        </div>

        <!-- 3 stars -->
        <div class="hstack gap-2">
            <div class="hstack fs-sm gap-1">
            3<i class="ci-star-filled text-warning"></i>
            </div>
            <div class="progress w-100" role="progressbar" aria-label="Three stars" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
            <div class="progress-bar bg-warning rounded-pill" style="width: 13%"></div>
            </div>
            <div class="fs-sm text-nowrap text-end" style="width: 40px;">9</div>
        </div>

        <!-- 2 stars -->
        <div class="hstack gap-2">
            <div class="hstack fs-sm gap-1">
            2<i class="ci-star-filled text-warning"></i>
            </div>
            <div class="progress w-100" role="progressbar" aria-label="Two stars" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
            <div class="progress-bar bg-warning rounded-pill" style="width: 6%"></div>
            </div>
            <div class="fs-sm text-nowrap text-end" style="width: 40px;">4</div>
        </div>

        <!-- 1 star -->
        <div class="hstack gap-2">
            <div class="hstack fs-sm gap-1">
            1<i class="ci-star-filled text-warning"></i>
            </div>
            <div class="progress w-100" role="progressbar" aria-label="One star" aria-valuenow="3.5" aria-valuemin="0" aria-valuemax="100" style="height: 4px">
            <div class="progress-bar bg-warning rounded-pill" style="width: 3.5%"></div>
            </div>
            <div class="fs-sm text-nowrap text-end" style="width: 40px;">3</div>
        </div>
        </div>
    </div>
    </div>

    <!-- Review -->
    @foreach ($goods as $item)
        <div class="border-bottom py-3 mb-3">
            <div class="d-flex align-items-center mb-3">
                <div class="text-nowrap me-3">
                <span class="h6 mb-0">{{$item['username']}}</span>
                <i class="ci-check-circle text-success align-middle ms-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-sm" data-bs-title="Verified customer"></i>
                </div>
                <span class="text-body-secondary fs-sm ms-auto">{{$item['created_at']}}</span>
            </div>
            <div class="d-flex gap-1 fs-sm pb-2 mb-1">
                @for($i = 0; $i < $item['rating']; $i++)
                    <i class="ci-star-filled text-warning"></i>
                @endfor
                @for($i = 5- $item['rating']; $i > 0; $i--)
                    <i class="ci-star text-body-tertiary opacity-75"></i>
                @endfor
            </div>
            <ul class="list-inline gap-2 pb-2 mb-1">
                <li class="fs-sm me-4"><span class="text-dark-emphasis fw-medium">Color:</span> Blue</li>
                <li class="fs-sm"><span class="text-dark-emphasis fw-medium">Model:</span> 128GB</li>
            </ul>
            <p class="h4 mb-2">{{$item['title']}}</p>
            <p class="fs-sm">{{$item['comment']}}</p>
            <ul class="list-unstyled fs-sm pb-2 mb-1">
                <li><span class="text-dark-emphasis fw-medium">Pros:</span> Powerful A15 Bionic chip, improved camera</li>
                <li><span class="text-dark-emphasis fw-medium">Cons:</span> High price tag</li>
            </ul>
            <div class="nav align-items-center">
                <button type="button" class="nav-link animate-underline px-0">
                <i class="ci-corner-down-right fs-base ms-1 me-1"></i>
                <span class="animate-target">Reply</span>
                </button>
                <button type="button" class="nav-link text-body-secondary animate-scale px-0 ms-auto me-n1">
                <i class="ci-thumbs-up fs-base animate-target me-1"></i>
                {{$likeCount}}
                </button>
                <hr class="vr my-2 mx-3">
                <button type="button" class="nav-link text-body-secondary animate-scale px-0 ms-n1">
                <i class="ci-thumbs-down fs-base animate-target me-1"></i>
                {{$unlikeCount}}
                </button>
            </div>
        </div>
    @endforeach

      <div class="nav">
        <a class="nav-link text-primary animate-underline px-0" href="shop-product-reviews-electronics">
          <span class="animate-target">See all reviews</span>
          <i class="ci-chevron-right fs-base ms-1"></i>
        </a>
      </div>

</div>
