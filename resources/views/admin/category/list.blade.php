<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <th width='200'>ref</th>
        <th width='200'>level</th>
        <th width='200'>pos</th>
        <th width='200'>카테고리</th>
        <th width='100'>상품수</th>
        <th>slug</th>
        <th width='200'>담당자</th>
        <th width='200'>등록일자</th>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">
                <td>
                    {{$item->ref}}
                </td>
                <td>
                    {{$item->level}}
                </td>
                <td>
                    {{$item->pos}}
                </td>
                <td width='200'>
                    <x-click wire:click="edit({{$item->id}})">
                        @if($item->enable)
                            {{$item->name}}
                        @else
                            <span style="text-decoration-line: line-through;">
                                {{$item->name}}
                            </span>
                        @endif
                    </x-click>
                </td>
                <td width='00'>
                    <a href="/admin/shop/products">
                        {{$item->goods}}
                    </a>
                </td>
                <td>
                    {{$item->slug}}
                </td>
                <td width='200'>
                    {{$item->manager}}
                </td>
                <td width='200'>
                    {{$item->created_at}}
                </td>
            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>
