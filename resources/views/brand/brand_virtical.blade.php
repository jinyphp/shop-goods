<div class="">
    <!-- Heading -->
    <div class="border-b py-2 mb-6 flex items-center justify-between">
        <h3 class="uppercase font-semibold tracking-wide">
            브랜드
        </h3>
        <div>
            <button type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-6 rounded border-transparent text-gray-600 hover:text-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span>more</span>
            </button>
        </div>
    </div>
    <!-- END Heading -->

    <div class="grid grid-cols-1 gap-4 mb-6">
        @foreach($brands as $item)
        <div class="px-4 ">
            @if($item->link)
            <a href="{{$item->link}}">{{$item->name}}</a>
            @else
            {{$item->name}}
            @endif
        </div>
        @endforeach
    </div>


</div>
