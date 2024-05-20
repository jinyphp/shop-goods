<x-www-layout>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-5">
            <div class="text-center">
                <h2 class="fw-bolder">Brands</h2>
                <p class="lead fw-normal text-muted mb-5">인기있는 브랜드 목록 입니다.</p>
            </div>

        </div>
    </section>


    <!-- Section-->
    <section class="py-5">
        <div class="container px-5">


            @livewire('shop-brand',[
                'widget'=>[

                ]
            ])

        </div>
    </section>

</x-www-layout>
