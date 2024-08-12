<div>

    <x-ui-divider>Options</x-ui-divider>

    @includeIf('jiny-shop-goods::detail_v2.info.option_edit', [])

    <x-ui-divider> Update </x-ui-divider>

    <button class="btn btn-primary" wire:click="update">수정</button>

</div>

