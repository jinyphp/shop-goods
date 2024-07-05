{{-- 라이브와이어로 blade를 만들때, 최상단에 <div></div> 로 감쌰져 있어야 한다. 루트 테그 --}}
<div>
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">

            @foreach($rows as $key => $item)
                @if($loop->first)
                <div class="carousel-item active">
                    <img src="{{$item->image}}" class="d-block w-100" alt="...">
                </div>
                @else
                <div class="carousel-item">
                    <img src="{{$item->image}}" class="d-block w-100" alt="...">
                </div>
                @endif

            @endforeach

        </div>
        <button class="carousel-control-prev" type="button"
            data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button"
            data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

</div>
