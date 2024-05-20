<div>
    <div class="small mb-1">SKU: BST-498</div>
    <h1 class="display-5 fw-bolder">
        @if(isset($forms['name']))
            {{$forms['name']}}
        @else
        상품명을 지정해주세요.
        @endif
    </h1>
    <div class="fs-5 mb-5">
        <span class="text-decoration-line-through">$45.00</span>
        <span>$40.00</span>
    </div>
    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
    <div class="d-flex">

        {{-- <button class="btn btn-secondary">+</button> --}}
        <input class="form-control text-center me-3"
            id="inputQuantity"
            type="num"
            value="1"
            style="max-width: 3rem" />
        {{-- <button class="btn btn-secondary">-</button> --}}


        <button class="btn btn-outline-dark flex-shrink-0" type="button">
            <i class="bi-cart-fill me-1"></i>
            Add to cart
        </button>
    </div>
</div>
