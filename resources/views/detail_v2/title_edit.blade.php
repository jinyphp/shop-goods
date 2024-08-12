<div>
    <!-- Title -->
    <div class="mb-3">
        <label for="simpleinput" class="form-label">상품명</label>
        <input type="text" class="form-control"
            wire:model.defer="forms.name">
    </div>

    <div class="mb-3">
        <label for="simpleinput" class="form-label">간략설명</label>
        {!! xTextarea()
            ->setWire('model.defer',"forms.short_description")
        !!}
    </div>

    <x-flex-between>
        <div></div>
        <div>
            <button class="btn btn-primary btn-sm" wire:click="update">수정</button>
        </div>
    </x-flex-between>


</div>

