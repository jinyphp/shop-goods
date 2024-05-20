<div class="flex items-center space-x-2 bg-gray-100 mb-2 p-4">
    <div class="p-2 text-bold">
        많이 찾으시는 브랜드 입니다.
    </div>
    @foreach($brands as $item)
    <div class="px-2 border-l border-gray-300">
        @if($item->link)
        <a href="{{$item->link}}">{{$item->name}}</a>
        @else
        {{$item->name}}
        @endif
    </div>
    @endforeach
</div>
