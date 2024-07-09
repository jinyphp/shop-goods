<div>
    @if($product['image'])
    <img class="card-img-top mb-5 mb-md-0"
        src="/{{$product['image']}}"
        alt="..." />
    @else
    <img class="card-img-top mb-5 mb-md-0"
        src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." />
    @endif
</div>
