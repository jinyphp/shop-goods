{{-- 목록을 출력하기 위한 템플릿 --}}
<x-theme theme="admin.sidebar">
    <x-theme-layout>
        <!-- Module Title Bar -->
        @if(Module::has('Titlebar'))
            @livewire('TitleBar', ['actions'=>$actions])
        @endif
        <!-- end -->


        <div class="relative">
            <div class="absolute right-0 bottom-4">
                <div class="btn-group">
                    <x-button id="btn-livepopup-manual" secondary wire:click="$emit('popupManualOpen')">메뉴얼</x-button>
                    <x-popup-form-create>신규추가</x-popup-form-create>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            document.querySelector("#btn-json-convert").addEventListener("click",function(e){
                e.preventDefault();
                Livewire.emit('encodeToJson');
            });

            document.querySelector("#btn-livepopup-manual").addEventListener("click",function(e){
                e.preventDefault();
                Livewire.emit('popupManualOpen');
            });
        </script>
        @endpush


        <x-card>
            <x-card-header>
            </x-card-header>
            <x-card-body>
                @livewire('AdminWireCateDrag',['cate_id'=>$request->cate_id, 'actions'=>$actions])
            </x-card-body>
            <x-card-footer>
                {{--
                @livewire('WireUpload',['vate_id'=>$request->cate_id])
                --}}
            </x-card-footer>
        </x-card>


        {{-- create/update/delete 처리 --}}

        @livewire('AdminCatePopupFrom', ['cate_id'=>$request->cate_id, 'actions'=>$actions])

        @livewire('Popup-LiveManual')


        {{-- Admin Rule Setting --}}
        <div class="px-2 py-2 bg-gray-300">
            <x-button id="btn-livepopup-rule" secondary>
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Rule
            </x-button>
        </div>
        @push('scripts')
        <script>
            document.querySelector("#btn-livepopup-rule").addEventListener("click",function(e){
                e.preventDefault();
                Livewire.emit('popupRuleOpen');
            });
        </script>
        @endpush
        @livewire('setActionRule', ['actions'=>$actions])

    </x-theme-layout>
</x-theme>
