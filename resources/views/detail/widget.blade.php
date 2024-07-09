<div class="bg-300">
    상품정보출력 <br>

    상품이름 : {{$product->name}} <br>
    짧은 설명 : {{$product->short_description}} <br>
    상품가격 : {{$product->regular_price}} <br>
    할인가 : {{$product->sale_price}} <br>
    상품코드 : {{$product->SKU}} <br>
    재고 : {{$product->quantity}} <br>

    주문수량={{$qty}} <br>
    <button wire:click="increaseQuantity()">증가</button>
    <button wire:click="decreaseQuantity()">감소</button>

</div>
