<div>

    <x-ui-divider>Options</x-ui-divider>

    @includeIf('jiny-shop-goods::detail_v2.info.option_edit', [])

    <x-ui-divider> Update </x-ui-divider>
    <x-flex-between>
        <div>

        </div>
        <div>
            <button class="btn btn-secondary btn-sm" wire:click="cancel">취소</button>
            <button class="btn btn-primary btn-sm" wire:click="update">수정</button>
        </div>
    </x-flex-between>



</div>

