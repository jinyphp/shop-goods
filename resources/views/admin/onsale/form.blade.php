<x-navtab class="mb-3 nav-bordered">

    <!-- formTab -->
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
            <x-form-label>시작</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.sale_start")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>종료</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.sale_end")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

        <x-form-hor>
            <x-form-label>제목</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.title")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>






    </x-navtab-item>

    <x-navtab-item class="" >
        <x-navtab-link class="rounded-0">
            <span class="d-none d-md-block">행사내용</span>
        </x-navtab-link>

        <x-form-hor>
            <x-form-label>컨덴츠</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.content")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>
    </x-navtab-item>

    <x-navtab-item class="" >
        <x-navtab-link class="rounded-0">
            <span class="d-none d-md-block">메모</span>
        </x-navtab-link>

        <x-form-hor>
            <x-form-label>description</x-form-label>
            <x-form-item>
                {!! xInputText()
                    ->setWire('model.defer',"forms.description")
                    ->setWidth("standard")
                !!}
            </x-form-item>
        </x-form-hor>

    </x-navtab-item>

</x-navtab>

