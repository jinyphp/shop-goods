<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <th width='100'>상품</th>

        <th width='100'>image</th>
        <th>설명</th>
        <th width='100'>순번</th>
        <th width='200'>등록일자</th>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">
                <td width='100'>
                    <a href="/admin/shop/products">
                        {{$item->goods}}
                    </a>


                </td>
                <td width='100'>
                    <x-click wire:click="edit({{$item->id}})">
                        <img src="/{{$item->image}}" class="w-100"
                            alt="{{$item->description}}">
                    </x-click>
                </td>
                <td>
                    <x-badge-primary>{{$item->type}}</x-badge-primary>
                    {{$item->description}}
                </td>
                <td width='100'>{{$item->pos}}</td>
                <td width='200'>{{$item->created_at}}</td>
            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

