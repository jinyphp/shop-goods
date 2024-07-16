<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <th width='100'>상태</th>
        <th>제목</th>
        <th width='100'>시작</th>
        <th width='100'>종료</th>
        <th width='100'>status</th>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">
                <td width='100'>{{$item->status}}</td>
                <td>{{$item->title}}</td>
                <td width='100'>{{$item->sale_start}}</td>
                <td width='100'>{{$item->sale_end}}</td>
                <td width='100'>{{$item->status}}</td>

            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

