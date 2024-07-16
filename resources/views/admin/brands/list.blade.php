<x-wire-table>
    {{-- 테이블 제목 --}}
    <x-wire-thead>
        <th width='100'>image</th>
        <th>
            name
        </th>
        <th width='100'>link</th>
        <th width='100'>type</th>

        <th width='100'>svg</th>
        <th width='100'>manager</th>
        <th width='100'>email</th>
        <th width='100'>phone</th>

        <th width='200'>등록일자</th>
    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            {{-- 테이블 리스트 --}}
            <x-wire-tbody-item :selected="$selected" :item="$item">
                <td width='100'>{{$item->image}}</td>
                <td>
                    <x-click wire:click="edit({{$item->id}})">
                        @if($item->enable)
                            {{$item->name}}
                        @else
                            <span style="text-decoration-line: line-through;">
                                {{$item->name}}
                            </span>
                        @endif
                    </x-click>
                    <p>{{$item->description}}</p>
                </td>

                <td width='100'>{{$item->link}}</td>
                <td width='100'>{{$item->type}}</td>

                <td width='100'>{{$item->svg}}</td>
                <td width='100'>{{$item->manager}}</td>
                <td width='100'>{{$item->email}}</td>
                <td width='100'>{{$item->phone}}</td>

                <td width='200'>{{$item->created_at}}</td>

            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>

