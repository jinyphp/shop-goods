<x-navtab class="mb-3 nav-bordered">
    <!-- formTab(detault) -->
    <x-navtab-item class="show active" >
        <x-navtab-link class="rounded-0 active">
            <span class="d-none d-md-block">기본정보</span>
        </x-navtab-link>

        <x-form-hor>
            <x-form-label>활성화</x-form-label>
            <x-form-item>
                {!! xCheckbox()
                    ->setWire('model.defer',"forms.enable")
                !!}
            </x-form-item>
        </x-form-hor>


        <x-form-hor>
            <x-form-label>가격유형</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.name")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>




    </x-navtab-item>

    <!-- formTab(others) -->
    <x-navtab-item class="" >
        <x-navtab-link class="rounded-0">
            <span class="d-none d-md-block">상세정보</span>
        </x-navtab-link>

        <x-form-hor>
            <x-form-label>담당자</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.manager")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>상세설명</x-form-label>
            <x-form-item>
                {!! xTextarea()
                    ->setWire('model.defer',"forms.description")
                !!}
            </x-form-item>
        </x-form-hor>

    </x-navtab-item>

</x-navtab>
