<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <tr>
            <th width='20'>
                <input type='checkbox' class="form-check-input" wire:model="selectedall">
            </th>
            <th width='100'>enable</th>
            <th width='100'>name</th>
            <th width='100'>number</th>
            <th width='100'>security_manager</th>
            <th width='100'>domain</th>
            <th width='100'>email</th>
            <th width='100'>phone</th>
            <th width='100'>phone2</th>
            <th width='100'>address</th>
            <th width='100'>map</th>
            <th width='100'>twiter</th>
            <th width='100'>facebook</th>
            <th width='100'>pinterest</th>
            <th width='100'>instagram</th>
            <th width='100'>youtube</th>

        </tr>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">

                <td width='100'>{{$item->enable}}</td>
                <td width='100'>{{$item->name}}</td>
                <td width='100'>{{$item->number}}</td>
                <td width='100'>{{$item->security_manager}}</td>
                <td width='100'>{{$item->domain}}</td>
                <td width='100'>{{$item->email}}</td>
                <td width='100'>{{$item->phone}}</td>
                <td width='100'>{{$item->phone2}}</td>
                <td width='100'>{{$item->address}}</td>
                <td width='100'>{{$item->map}}</td>
                <td width='100'>{{$item->twiter}}</td>
                <td width='100'>{{$item->facebook}}</td>
                <td width='100'>{{$item->pinterest}}</td>
                <td width='100'>{{$item->instagram}}</td>
                <td width='100'>{{$item->youtube}}</td>
            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

