<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <tr>
            <th width='20'>
                <input type='checkbox' class="form-check-input" wire:model="selectedall">
            </th>
            <th width='100'>product_id</th>
            <th width='100'>category_id</th>

        </tr>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">

                <td width='100'>{{$item->product_id}}</td>
                <td width='100'>{{$item->category_id}}</td>


            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

