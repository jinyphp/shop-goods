<x-theme theme="admin.sidebar">
    <x-theme-layout>

        {{-- Title --}}
        @if(isset($actions['view']['title']))
            @includeIf($actions['view']['title'])
        @else
            @includeIf("jiny-wire-table::table_popup_forms.title")
        @endif

        {{-- CRUD 테이블 --}}
        <section>
        <main>
            @livewire('admin-shop-prices', [
                'actions'=>$actions
            ])
        </main>
        </section>

    </x-theme-layout>
</x-theme>


