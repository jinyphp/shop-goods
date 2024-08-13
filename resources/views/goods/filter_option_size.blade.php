<div>
    @foreach ($selected as $i => $item)
    {{$item}}/
    @endforeach

    @foreach ($rows as $i => $item)
        <input type="checkbox" class="btn-check" id="size-{{$i}}"
            name='ids' value="{{ $item['id'] }}"
            wire:model.live="selected">
        <label for="size-{{$i}}" class="btn btn-sm btn-outline-secondary">
            {{ $item['name'] }}
        </label>
    @endforeach

{{--
    <input type="checkbox" class="btn-check" id="size-xxs" checked>
          <label for="size-xxs" class="btn btn-sm btn-outline-secondary">XXS</label>

          <input type="checkbox" class="btn-check" id="size-xs">
          <label for="size-xs" class="btn btn-sm btn-outline-secondary">XS</label>

          <input type="checkbox" class="btn-check" id="size-s">
          <label for="size-s" class="btn btn-sm btn-outline-secondary">S</label>

          <input type="checkbox" class="btn-check" id="size-m">
          <label for="size-m" class="btn btn-sm btn-outline-secondary">M</label>

          <input type="checkbox" class="btn-check" id="size-l">
          <label for="size-l" class="btn btn-sm btn-outline-secondary">L</label>

          <input type="checkbox" class="btn-check" id="size-xl">
          <label for="size-xl" class="btn btn-sm btn-outline-secondary">
            <span class="mx-n1">XL</span></label>

            <input type="checkbox" class="btn-check" id="size-2xl">
          <label for="size-2xl" class="btn btn-sm btn-outline-secondary">2XL</label>

          <input type="checkbox" class="btn-check" id="size-40">
          <label for="size-40" class="btn btn-sm btn-outline-secondary">40</label>

          <input type="checkbox" class="btn-check" id="size-42">
            <label for="size-42" class="btn btn-sm btn-outline-secondary">42</label>

          <input type="checkbox" class="btn-check" id="size-44">
          <label for="size-44" class="btn btn-sm btn-outline-secondary">44</label>

          <input type="checkbox" class="btn-check" id="size-45">
          <label for="size-45" class="btn btn-sm btn-outline-secondary">45</label>

          <input type="checkbox" class="btn-check" id="size-46">
          <label for="size-46" class="btn btn-sm btn-outline-secondary">46</label>

          <input type="checkbox" class="btn-check" id="size-48">
          <label for="size-48" class="btn btn-sm btn-outline-secondary">48</label>

          <input type="checkbox" class="btn-check" id="size-50">
          <label for="size-50" class="btn btn-sm btn-outline-secondary">50</label>

          <input type="checkbox" class="btn-check" id="size-52">
          <label for="size-52" class="btn btn-sm btn-outline-secondary">52</label> --}}
</div>
