<div>

    <div class="mb-3">
        <label for="simpleinput" class="form-label">가격</label>
        <input type="text" class="form-control"
            wire:model.defer="forms.price">
    </div>

    <div class="mb-3">
        <label for="simpleinput" class="form-label">할인금액</label>
        <input type="text" class="form-control"
            wire:model.defer="forms.discount">
    </div>

    <button class="btn btn-primary" wire:click="update">수정</button>

</div>

