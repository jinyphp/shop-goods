<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;
use \Jiny\Html\CTag;
// use Jiny\Shop\Entities\ShopSliders;

//use Livewire\WithFileUploads;

class Slider extends Component
{
    //use WithFileUploads;
    //use \Jiny\WireTable\Http\Trait\Upload;
    public $product;

    public function mount($product) {
        $this->product = $product;
    }

    public function render()
    {
        // dd($this->product);
        $rows = DB::table('shop_goods_images')
            ->where('goods',$this->product['id'])->get();

        // dd($rows);
        return view('jiny-shop-goods::goods.main.Slider',[
            'rows' => $rows
        ]);
    }
}
