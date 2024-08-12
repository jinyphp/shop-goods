@foreach($options as $type => $option)
@if(isset($option[0]['image']))
{{-- 이미지 선택 옵션 --}}
<div class="mb-4">
    <label class="form-label fw-semibold pb-1 mb-2">{{$type}} :
        <span class="text-body fw-normal" id="colorOption">
            @if(isset($optForms[$type]))
            {{$optForms[$type]}}
            @endif
        </span>
    </label>

    <div class="d-flex flex-wrap gap-2">
        @foreach($option as $i => $item)
        <input type="radio" class="btn-check" id="option-{{$type}}-{{$i}}"
            name="{{$type}}"
            value="{{$item['name']}}"
            wire:model.live="optForms.{{$type}}" checked>

        <label for="option-{{$type}}-{{$i}}"
            class="btn btn-image p-0"
            data-label="{{$item['name']}}">

            <img src="{{$item['image']}}" width="56"
                alt="{{$item['name']}}">

            <span class="visually-hidden">{{$item['name']}}</span>

        </label>
        @endforeach
    </div>

</div>

@else
{{-- 일반 셀렉트 --}}
<div class="mb-3">
    <div class="d-flex align-items-center justify-content-between mb-1">
        <label class="form-label fw-semibold mb-0">{{$type}}</label>
        <div class="nav">
            {{--
            <a class="nav-link animate-underline fw-normal px-0" href="#sizeGuide" data-bs-toggle="modal">
                <i class="ci-ruler fs-lg me-2"></i>
                <span class="animate-target">Size guide</span>
            </a>
            --}}
        </div>
    </div>
    <select class="form-select form-select-lg" wire:model="optForms.{{$type}}">
        @foreach($option as $item)
            @if($item['var'])
            <option value="{{$item['var']}}">{{$item['name']}}</option>
            @else
            <option value="{{$item['name']}}">{{$item['name']}}</option>
            @endif
        @endforeach
    </select>
</div>
@endif
@endforeach
