<div class="mb-3">
    <label for="simpleinput" class="form-label">이미지</label>
    <input type="file" class="form-control"
                wire:model.defer="forms.image">
    <p>
        @if(isset($forms['image']))
        {{$forms['image']}}
        @endif
    </p>
</div>

<div class="mb-3">
    <label for="simpleinput" class="form-label">이름</label>
    <input type="text" class="form-control"
                wire:model.defer="forms.name">
</div>
