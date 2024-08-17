<div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab">

    <!-- Heading + Add review button -->
    <div class="d-sm-flex align-items-center justify-content-between border-bottom pb-2 pb-sm-3">
        <div class="mb-3 me-sm-3">
            <h2 class="h5 pb-2 mb-1">고객 리뷰</h2>
            <div class="d-flex align-items-center text-body-secondary fs-sm">
                <div class="d-flex gap-1 me-2">
                    @for($i = 0; $i < intVal($ratingAvg); $i++)
                        <i class="ci-star-filled text-warning"></i>
                    @endfor

                    @for($i = 5 - intVal($ratingAvg); $i > 0; $i--)
                        <i class="ci-star text-body-tertiary opacity-60"></i>
                    @endfor
                </div>
                총 {{$total_review}}개의 리뷰
            </div>
        </div>
        <button type="button" class="btn btn-outline-dark mb-3" data-bs-toggle="modal"
            data-bs-target="#reviewForm">리뷰 남기기</button>
    </div>
    @foreach ($goods as $item)
        <!-- Review -->
        <div class="border-bottom py-4">
            <div class="row py-sm-2">
                <div class="col-md-4 col-lg-3 mb-3 mb-md-0">
                    <div class="d-flex h6 mb-2">
                        {{$item['username']}}
                        <i class="ci-check-circle text-success mt-1 ms-2" data-bs-toggle="tooltip"
                            data-bs-custom-class="tooltip-sm" title="Verified customer"></i>
                    </div>
                    <div class="fs-sm mb-2 mb-md-3">{{$item['created_at']}}</div>
                    <div class="d-flex gap-1 fs-sm">
                        @for($i = 0; $i < $item['rating']; $i++)
                            <i class="ci-star-filled text-warning"></i>
                        @endfor
                        @for($i = 5- $item['rating']; $i > 0; $i--)
                            <i class="ci-star text-body-tertiary opacity-75"></i>
                        @endfor
                    </div>
                </div>
                <div class="col-md-8 col-lg-9">
                    <p class="mb-md-1" style="font-size: 24px;"><strong>{{$item['title']}}</strong></p>
                    <p class="mb-md-4">{{$item['comment']}}
                    </p>
                    <div class="d-sm-flex justify-content-between">
                        <div
                            class="d-flex align-items-center fs-sm fw-medium text-dark-emphasis pb-2 pb-sm-0 mb-1 mb-sm-0">
                            <i class="ci-check fs-base me-1" style="margin-top: .125rem"></i>
                            네, 이 상품을 추천합니다.
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="fs-sm fw-medium text-dark-emphasis me-1">도움이 되셨나요?</div>
                            <button type="button" class="btn btn-sm btn-secondary" wire:click="increaseLike({{$item['id']}})">
                                <i class="ci-thumbs-up fs-sm ms-n1 me-1"></i>
                                {{$likeArr[$item['id']]['like']}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Pagination -->
    <nav class="mt-3 pt-2 pt-md-3" aria-label="Reviews pagination">
        <ul class="pagination">
            <li class="page-item active" aria-current="page">
                <span class="page-link">
                    1
                    <span class="visually-hidden">(current)</span>
                </span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#!">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#!">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#!">4</a>
            </li>
            <li class="page-item">
                <span class="page-link pe-none">...</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#!">6</a>
            </li>
        </ul>
    </nav>
</div>
