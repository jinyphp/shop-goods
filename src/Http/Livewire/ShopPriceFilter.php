<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class ShopPriceFilter extends Component
{
    public $actions = [];
    public $viewFile;
    //public $selected = [];

    //public $rows = [];
    //public $filter = [];
    //public $search;

    public $range1;
    public $range2;

    public function mount()
    {
        if(!$this->viewFile) {
            $this->viewFile = "jiny-shop-goods::goods.filter_price";
        }

        // 브랜드 데이터를 읽어옵니다.
        //$this->fetch();
    }

    private function fetch()
    {
        // DB에서 데이터를 읽어 옵니다.
        $db = DB::table("shop_brands");

        if($this->search) {
            $db->where('name', 'like', '%'.$this->search.'%');
        }

        $rows = $db->get();

        $this->rows = [];
        foreach($rows as $item) {
            $temp = [];
            $id = $item->id;
            foreach($item as $key => $value) {
                $temp[$key] = $value;
            }
            $this->rows[$id] = $temp;
        }
    }

    public function updatedSelected($value)
    {
        $filter = [];
        foreach($this->selected as $id) {
            $filter []= $id.":".$this->rows[$id]['name'];
        }

        $this->dispatch('setFilter', [
            'brand' => $filter
        ]);
    }

    public function render()
    {
        return view($this->viewFile,[
            //'rows'=>$rows
        ]);
    }

    public function range1FilterEnter(string $name)
    {
        $this->dispatch('setFilter', [
            '_price' => [
                'range1' => $this->range1,
                'range2' => $this->range2,
            ]
        ]);
    }

    public function range2FilterEnter(string $name)
    {
        $this->dispatch('setFilter', [
            '_price' => [
                'range1' => $this->range1,
                'range2' => $this->range2,
            ]
        ]);
    }

}
