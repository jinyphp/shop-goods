<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <tr>
            <th width='20'>
                <input type='checkbox' class="form-check-input" wire:model="selectedall">
            </th>
            <th width='100'>상품 활성화</th>
            <th width='100'>상품 판매 기간</th>
            <th width='100'>slug</th>
            <th width='100'>상품 이름</th>
            <th width='100'>상품 설명 제목</th>
            <th width='100'>짧은 설명</th>
            <th width='100'>긴 설명</th>
            <th width='100'>정가</th>
            <th width='100'>할인가</th>
            <th width='100'>단체 가격</th>
            <th width='100'>옵션 가격</th>
            <th width='100'>이벤트 가격</th>
            <th width='100'>환불 여부</th>
            <th width='100'>되팔기 허용 여부</th>
            <th width='100'>SKU</th>
            <th width='100'>재고 상태</th>
            <th width='100'>featured</th>
            <th width='100'>수량</th>
            <th width='100'>이미지</th>
            <th width='100'>카테고리 아이디</th>
            <th width='100'>옵션</th>
            <th width='100'>무료 배송 여부</th>
            <th width='100'>저자</th>
            <th width='100'>번역가</th>
        </tr>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">
                <td width='50'>
                    {{$item->enable}}
                </td>

                <td width='100'>{{$item->expire}}</td>
                <td width='100'>{{$item->slug}}</td>
                <td width='100'>{{$item->name}}</td>
                <td width='100'>{{$item->subtitle}}</td>
                <td width='100'>{{$item->short_description}}</td>
                <td width='100'>{{$item->description}}</td>
                <td width='100'>{{$item->regular_price}}</td>
                <td width='100'>{{$item->sale_price}}</td>
                <td width='100'>{{$item->unit_price}}</td>
                <td width='100'>{{$item->option_price}}</td>
                <td width='100'>{{$item->event_price}}</td>
                <td width='100'>{{$item->refund}}</td>
                <td width='100'>{{$item->buy}}</td>
                <td width='100'>{{$item->SKU}}</td>
                <td width='100'>{{$item->stock_status}}</td>
                <td width='100'>{{$item->featured}}</td>
                <td width='100'>{{$item->quantity}}</td>
                <td width='100'>{{$item->image}}</td>
                <td width='100'>{{$item->category_id}}</td>
                <td width='100'>{{$item->option}}</td>
                <td width='100'>{{$item->shipping_free}}</td>
                <td width='100'>{{$item->author}}</td>
                <td width='100'>{{$item->translator}}</td>


            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

