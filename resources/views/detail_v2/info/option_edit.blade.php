{{-- 옵션 추가 및 수정 --}}
<ul>
@foreach ($options as $key => $item)
    <li>
        <span>{{$key}}</span>
        <ul>
        @foreach($item as $opt)
            <li>
                <span>{{$opt['name']}}</span>
                <x-click wire:click="optionRemoveItem('{{$key}}','{{$opt['name']}}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                </x-click>

            </li>
        @endforeach
            <li>
                {{-- 옵션 아이템 추가 --}}
                @if($newOptionItem == $key)
                <div class="row row-cols-sm-auto g-3 align-items-center">
                    <div class="col-12">
                        <label for="inline-form-input">name</label>
                        <input type="text" class="form-control form-control-sm" id="inline-form-input"
                            wire:model.defer="optionItem.name">
                    </div>
                    <div class="col-12">
                        <label for="inline-form-input">value</label>
                        <input type="text" class="form-control form-control-sm" id="inline-form-input"
                            wire:model.defer="optionItem.var">
                    </div>
                    <div class="col-12">
                        <label for="inline-form-input">이미지</label>
                        <input type="file" class="form-control form-control-sm"
                            id="inline-form-input"
                            wire:model.defer="optionItem.image">
                        {{-- {{ $optionOtem['image']->temporaryUrl() }} --}}
                    </div>
                    <div class="col-12">
                    <button type="submit" class="btn btn-primary"
                        wire:click="optionItemStore('{{$key}}')">Add</button>
                    </div>
                    <div class="col-12">

                        <button type="submit" class="btn btn-secondary"
                            wire:click="optionItemCancel()">cancel</button>
                    </div>
                </div>
                @else
                <x-click wire:click="optionAddItem('{{$key}}')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </x-click>
                @endif
            </li>
        </ul>


    </li>
@endforeach
    {{-- 새로운 옵션타입 추가 --}}
    <li>
        @if($newOption)
        <div class="row row-cols-sm-auto g-3 align-items-center">
            <div class="col-12">
            <label for="inline-form-input" class="visually-hidden">Key</label>
            <input type="text" class="form-control" id="inline-form-input"
                wire:model.defer="optionKey">
            </div>
            <div class="col-12">
            <button type="submit" class="btn btn-primary"
                wire:click="optionStore">Submit</button>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-secondary"
                    wire:click="optionCancel()">cancel</button>
            </div>
        </div>
        @else
        <x-click wire:click="optionCreate()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
        </x-click>
        @endif
    </li>
</ul>
