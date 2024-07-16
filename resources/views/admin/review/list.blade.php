<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <th width='100'>Id</th>
        <th width='100'>product_id</th>
        <th width='100'>product</th>
        <th width='100'>title</th>
        <th width='100'>review</th>
        <th width='100'>rank</th>
        <th width='100'>user_id</th>
        <th width='100'>username</th>
        <th width='100'>email</th>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">
                <td >
                    <x-click wire:click="edit({{$item->id}})">
                        {{$item->id}}
                    </x-click>
                </td>
                <td width='100'>{{$item->product_id}}</td>
                <td width='100'>{{$item->product}}</td>
                <td width='100'>{{$item->title}}</td>
                <td width='200'>{{$item->review}}</td>
                <td width='200'>{{$item->rank}}</td>
                <td width='200'>{{$item->user_id}}</td>
                <td width='200'>{{$item->username}}</td>
                <td width='200'>{{$item->email}}</td>
            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>
