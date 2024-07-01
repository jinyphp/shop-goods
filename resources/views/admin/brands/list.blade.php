<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <tr>
            <th width='20'>
                <input type='checkbox' class="form-check-input" wire:model="selectedall">
            </th>
            <th width='100'>enable</th>
            <th width='100'>name</th>
            <th width='100'>link</th>
            <th width='100'>type</th>
            <th width='100'>image</th>
            <th width='100'>svg</th>
            <th width='100'>manager</th>
            <th width='100'>email</th>
            <th width='100'>phone</th>
            <th width='100'>description</th>


        </tr>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">

                <td width='100'>{{$item->enable}}</td>
                <td width='100'>{{$item->name}}</td>
                <td width='100'>{{$item->link}}</td>
                <td width='100'>{{$item->type}}</td>
                <td width='100'>{{$item->image}}</td>
                <td width='100'>{{$item->svg}}</td>
                <td width='100'>{{$item->manager}}</td>
                <td width='100'>{{$item->email}}</td>
                <td width='100'>{{$item->phone}}</td>
                <td width='100'>{{$item->description}}</td>


            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

