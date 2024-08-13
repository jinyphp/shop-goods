<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class ShopBrandsFilter extends Component
{
    public $actions = [];
    public $viewFile;
    public $selected = [];

    public $rows = [];
    //public $filter = [];
    public $search;

    public function mount()
    {
        if(!$this->viewFile) {
            $this->viewFile = "jiny-shop-goods::goods.filter_brand";
        }

        // 브랜드 데이터를 읽어옵니다.
        $this->fetch();
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

    public function searchFilterEnter(string $name)
    {
        // 브랜드 데이터를 검색하여 다시 읽어옵니다.
        $this->fetch();

        // dd($name);
        //dd($this->transType);
        //$this->emit('transGoodSearch', $name, $this->transType, $this->company);
        // $this->dispatch('transGoodSearch', $name, $this->transType, $this->company);
    }

}
