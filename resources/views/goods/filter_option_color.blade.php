<div>
    @foreach ($selected as $i => $item)
    {{$item}}/
    @endforeach

    @foreach ($rows as $i => $item)
    <div class="d-flex align-items-center mb-1">
        <input type="checkbox" class="btn-check" id="color-{{$i}}"
            name='ids' value="{{ $item['id'] }}"
            wire:model.live="selected">
        <label for="color-{{$i}}" class="btn btn-color fs-xl"
            style="color: #8bc4ab">
        </label>
        <label for="color-{{$i}}" class="fs-sm ms-2">
            {{$item['name']}}
        </label>
      </div>
    @endforeach
{{--
      <div class="d-flex align-items-center mb-1">
        <input type="checkbox" class="btn-check" id="red">
        <label for="red" class="btn btn-color fs-xl" style="color: #ee7976"></label>
        <label for="red" class="fs-sm ms-2">Coral red</label>
      </div>
      <div class="d-flex align-items-center mb-1">
        <input type="checkbox" class="btn-check" id="pink">
        <label for="pink" class="btn btn-color fs-xl" style="color: #df8fbf"></label>
        <label for="pink" class="fs-sm ms-2">Pink</label>
      </div>
      <div class="d-flex align-items-center mb-1">
        <input type="checkbox" class="btn-check" id="blue">
        <label for="blue" class="btn btn-color fs-xl" style="color: #9acbf1"></label>
        <label for="blue" class="fs-sm ms-2">Sky blue</label>
      </div>
      <div class="d-flex align-items-center mb-1">
        <input type="checkbox" class="btn-check" id="black">
        <label for="black" class="btn btn-color fs-xl" style="color: #364254"></label>
        <label for="black" class="fs-sm ms-2">Black</label>
      </div>
      <div class="d-flex align-items-center mb-1">
        <input type="checkbox" class="btn-check" id="white">
        <label for="white" class="btn btn-color fs-xl" style="color: #e0e5eb"></label>
        <label for="white" class="fs-sm ms-2">White</label>
      </div> --}}
</div>
