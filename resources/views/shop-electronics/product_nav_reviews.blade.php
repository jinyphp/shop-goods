<!-- Nav links + Reviews -->
<section class="container pb-2 pb-lg-4">
    <div class="d-flex align-items-center border-bottom">
      <ul class="nav nav-underline flex-nowrap gap-4">
        <li class="nav-item me-sm-2">
          <a class="nav-link pe-none active" href="#!">General info</a>
        </li>
        <li class="nav-item me-sm-2">
          <a class="nav-link" href="shop-product-details-electronics">Product details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shop-product-reviews-electronics">Reviews ({{$totalReview}})</a>
        </li>
      </ul>
      <a class="d-none d-md-flex align-items-center gap-2 text-decoration-none ms-auto mb-1" href="#reviews">
        <div class="d-flex gap-1 fs-sm">
            @for($i = 0; $i < intVal($ratingAvg); $i++)
                <i class="ci-star-filled text-warning"></i>
            @endfor

            @for($i = 5 - intVal($ratingAvg); $i > 0; $i--)
                <i class="ci-star text-body-tertiary opacity-60"></i>
            @endfor
        </div>
        <span class="text-body-tertiary fs-xs">{{$totalReview}} reviews</span>
      </a>
    </div>
  </section>
