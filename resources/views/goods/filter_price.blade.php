<div>
    <div class="range-slider">
        <div class="range-slider-ui"></div>

        <div class="d-flex align-items-center">
          <div class="position-relative w-50">
            <i class="ci-dollar-sign position-absolute top-50 start-0 translate-middle-y ms-3"></i>
            <input type="number" class="form-control form-icon-start"
                wire:model.defer="range1"
                wire:keydown.enter="range1FilterEnter($event.target.value)"
                min="0">

          </div>

          <i class="ci-minus text-body-emphasis mx-2"></i>
          <div class="position-relative w-50">
            <i class="ci-dollar-sign position-absolute top-50 start-0 translate-middle-y ms-3"></i>
            <input type="number" class="form-control form-icon-start"
                wire:model.defer="range2"
                wire:keydown.enter="range2FilterEnter($event.target.value)"
                min="0">
          </div>
        </div>

      </div>
</div>
