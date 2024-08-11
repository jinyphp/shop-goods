<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

/**
 * 상품 가격 검색 필터
 */
class ShopPriceFilter extends Component
{
    public $actions = [];
    public $viewFile;

    public $range1; // 가격1
    public $range2; // 가격2

    public function mount()
    {
        // 화면 주입
        if(!$this->viewFile) {
            $this->viewFile = "jiny-shop-goods::goods.filter_price";
        }
    }

    public function render()
    {
        return view($this->viewFile,[
        ]);
    }

    // 가격1: 이벤트 발생
    public function range1FilterEnter(string $name)
    {
        $this->dispatch('setFilter', [
            '>price' => [
                'range1' => $this->range1,
                'range2' => $this->range2,
            ]
        ]);
    }

    // 가격2: 이벤트 발생
    public function range2FilterEnter(string $name)
    {
        $this->dispatch('setFilter', [
            '<price' => [
                'range1' => $this->range1,
                'range2' => $this->range2,
            ]
        ]);
    }

}
