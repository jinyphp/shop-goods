<div class="accordion-body p-0 pb-4 mb-1 mb-xl-2">
    <style>
        /* For WebKit browsers */
        div::-webkit-scrollbar {
            width: 5px; /* Set scrollbar width to 5px */
        }

        div::-webkit-scrollbar-thumb {
            background-color: #888; /* Set the color of the scrollbar thumb */
            border-radius: 10px; /* Optional: make the scrollbar rounded */
        }

        div::-webkit-scrollbar-track {
            background-color: #f1f1f1; /* Set the color of the scrollbar track */
        }
        </style>

    {{-- 브랜드 상품 검색 --}}
    <div class="position-relative mb-3">
        <i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
        <input type="search"
            class="brands-search form-control form-icon-start"
            wire:model.defer="search"
            wire:keydown.enter="searchFilterEnter($event.target.value)"
            placeholder="Search">


    </div>

    {{-- @foreach ($selected as $i => $item)
    {{$item}}/
    @endforeach --}}

    {{-- 스크롤 기능 --}}
    {{-- data-simplebar data-simplebar-auto-hide="false" --}}
    <div style="height: 210px;overflow-y:scroll;scrollbar-width: thin;" >

        <div class="brands-list d-flex flex-column gap-2">
            @foreach ($rows as $i => $item)
                <div class="form-check mb-0">
                    <input type="checkbox" class="form-check-input" id="brand-filter-{{$i}}"
                    name='ids' value="{{ $item['id'] }}"
                    wire:model.live="selected">
                    {{-- <input type='checkbox'   class="form-check-input"
                        > --}}

                    <label for="brand-filter-{{$i}}" class="form-check-label text-body-emphasis">
                        {{ $item['name'] }} <span class="fs-xs text-body-secondary ms-1">(425)</span>
                    </label>
                </div>
            @endforeach
        </div>

    </div>
</div>
