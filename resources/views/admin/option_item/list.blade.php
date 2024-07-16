<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>

        <th width='100'>name</th>
        <th width='100'>value</th>
        <th width='100'>stock</th>
        <th width='100'>price</th>
        <th width='100'>nested</th>
        <th>description</th>
        <th width='200'>등록일자</th>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">


                <td width='100'>
                    <x-click wire:click="edit({{$item->id}})">
                        {{$item->name}}
                    </x-click>
                </td>
                <td width='100'>{{$item->value}}</td>
                <td width='100'>{{$item->stock}}</td>
                <td width='100'>{{$item->price}}</td>
                <td width='100'>{{$item->nested}}</td>
                <td>{{$item->description}}</td>
                <td width='200'>{{$item->created_at}}</td>

            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

