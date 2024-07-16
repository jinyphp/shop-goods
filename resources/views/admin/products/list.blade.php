<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <th width='100'>카테고리</th>
        <th width='100'>이미지</th>
            <th>
                상품명
            </th>
            <th width='100'>
                옵션
            </th>

            <th width='200'>
                가격
            </th>


            <th width='100'>
                환불 여부
            </th>
            <th width='100'>
                되팔기 허용 여부
            </th>
            <th width='100'>
                SKU
            </th>

            <th width='100'>
                featured
            </th>
            <th width='100'>
                수량
            </th>


            <th width='100'>무료 배송 여부</th>

            <th width='150'>
                상품 판매 기간
            </th>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">
                <td width='100'>
                    <div>
                        상품번호: {{$item->id}}
                    </div>
                    <div>
                        <a href="/admin/shop/category">
                            <x-badge-success>{{$item->category_id}}</x-badge-success>
                        </a>
                    </div>
                </td>
                <td width='100'>
                    <x-click wire:click="edit({{$item->id}})">
                        <img src="/{{$item->image}}" style="width:90%;" alt="">
                    </x-click>
                </td>
                <td>
                    @if($item->slug)
                    <x-badge-secondary>{{$item->slug}}</x-badge-secondary>
                    @endif



                    <div>
                        <x-click wire:click="edit({{$item->id}})">
                            @if($item->enable)
                                {{$item->name}}
                            @else
                                <span style="text-decoration-line: line-through;">
                                    {{$item->name}}
                                </span>
                            @endif
                        </x-click>
                    </div>
                    <div>
                        {{$item->short_description}}
                    </div>
                    <div>{{$item->subtitle}}</div>
                    {{-- 상품 상세 설명 --}}
                    {{--
                    <div>
                        {{$item->description}}
                    </div>
                    --}}

                </td>

                <td width='100'>
                    {{$item->option}}
                </td>

                <td width='200'>
                    <ul>
                        <li>정가 : {{$item->regular_price}}</li>
                        <li>할인가 : {{$item->sale_price}}</li>
                        <li>단체 가격 : {{$item->unit_price}}</li>
                        <li>옵션 가격 : {{$item->option_price}}</li>
                        <li>이벤트 가격 : {{$item->event_price}}</li>
                    </ul>
                </td>


                <td width='100'>
                    {{$item->refund}}
                </td>

                <td width='100'>
                    {{$item->SKU}}
                </td>
                <td width='100'>

                </td>
                <td width='100'>
                    {{$item->featured}}
                </td>
                <td width='100'>
                    <div>{{$item->quantity}}</div>
                    <x-badge-primary>{{$item->stock_status}}</x-badge-primary>
                </td>

                <td width='100'>
                    {{$item->shipping_free}}
                </td>

                <td width='150'>
                    {{$item->expire}}
                </td>

            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

