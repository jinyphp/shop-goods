<div>

    <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link {{ $currentTab === 'details' ? 'active' : '' }}"
             aria-current="page"
             href="#"
             wire:click.prevent="setTab('details')">상세 정보</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $currentTab === 'reviews' ? 'active' : '' }}"
             href="#"
             wire:click.prevent="setTab('reviews')">후기</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $currentTab === 'styles' ? 'active' : '' }}"
             href="#"
             wire:click.prevent="setTab('styles')">사이즈</a>
        </li>
    </ul>

    <div class="tab-content">
        @if ($currentTab === 'details')
            {{-- 상품 상세 정보 --}}
            @livewire("ShopProductDescription", ['product'=>$product])
        @elseif ($currentTab === 'reviews')
            {{-- 상품 후기 --}}
            @livewire('ShopProductReview')
        @elseif ($currentTab === 'styles')
            {{-- 상품 사이즈 --}}
            {{-- @livewire('ShopProductSize') --}}
            S <br>
            L <br>
            XL<br>
        @endif
    </div>
</div>
