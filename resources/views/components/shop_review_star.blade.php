<a {{ $attributes->merge([
    'class'=>"d-none d-md-flex align-items-center gap-2 text-decoration-none mb-3"
    ]) }}>
    <div class="d-flex gap-1 fs-sm">
        @for($i=0; $i<$value; $i+=20)
        <i class="ci-star-filled text-warning"></i>
        @endfor

        @for( ; $i<100; $i+=20)
        <i class="ci-star text-body-tertiary opacity-75"></i>
        @endfor
    </div>

    <span class="text-body-tertiary fs-sm">
        {{$slot}}
    </span>
</a>
