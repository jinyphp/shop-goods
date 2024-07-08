<div>
    <div class="tabs">
        <button wire:click="setTab('details')">상세 정보</button>
        <button wire:click="setTab('reviews')">후기</button>
        <button wire:click="setTab('styles')">사이즈</button>
    </div>

    <div class="tab-content">
        @if ($currentTab === 'details')
            {{-- 상품 상세 정보 --}}
            1
        @elseif ($currentTab === 'reviews')
            {{-- 상품 후기 --}}
            2
        @elseif ($currentTab === 'styles')
            {{-- 상품 사이즈 --}}
            3
        @endif
    </div>
</div>
