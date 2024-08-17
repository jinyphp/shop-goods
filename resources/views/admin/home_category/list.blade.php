<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <tr>
            <th width='20'>
                <input type='checkbox' class="form-check-input" wire:model="selectedall">
            </th>
            <th width='100'>id</th>
            <th width='100'>ref</th>
            <th width='100'>level</th>
            <th width='100'>pos</th>
            <th width='100'>sel_categories</th>
            <th width='100'>no_of_products</th>

        </tr>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">

                <td width='100'>{{$item->id}}</td>
                <td width='100'>{{$item->ref}}</td>
                <td width='100'>{{$item->level}}</td>
                <td width='100'>{{$item->pos}}</td>
                <td width='100'>{{$item->sel_categories}}</td>
                <td width='100'>{{$item->no_of_products}}</td>

            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

