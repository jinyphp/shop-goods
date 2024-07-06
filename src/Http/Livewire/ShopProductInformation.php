<?php

namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;

use \Jiny\Html\CTag;
use Jiny\Shop\Entities\ShopProducts;
use Cart;

class ShopProductInformation extends Component
{
    public $product;
    public $information;

    public function render()
    {
        $product = $this->product;

        // 상품 상세 페이지
        $datePath = str_replace("-","/", explode(" ",$product['created_at'])[0]);
        $path = resource_path('views/shop/details/'.$datePath);

        // dump($datePath);
        // dd($path);
        if(!is_dir($path.'/'.$product['id'])) mkdir($path.'/'.$product['id'], 0755, true);
        if(!file_exists($path.'/'.$product['id']."/information.blade.php")) {
            $information = "상품 상세 정보가 없습니다.";
            file_put_contents($path.'/'.$product['id']."/information.blade.php", $information);
        } else {
            $information = file_get_contents($path.'/'.$product['id']."/information.blade.php");
        }

        $this->information = $information;
        return view('jiny-shop-goods::detail.information');
    }

    /**
     * Popup Admin
     */
    public $admin;
    public $popup = false;
    public $forms = [];
    public $_id;

    public function edit($id)
    {
        $this->_id = $id;
        $this->popup = true;
        /*
        $row = DB::table('shop_products')->where('id', $id)->first();
        $this->forms = [];
        foreach($row as $key => $value) {
            $this->forms[$key] = $value;
        }
        */
    }

    public function update()
    {

        $product = $this->product;

        // 상품 상세 페이지
        $datePath = str_replace("-","/", explode(" ",$product['created_at'])[0]);
        $path = resource_path('views/shop/details/'.$datePath);
        if(!is_dir($path.'/'.$product['id'])) mkdir($path.'/'.$product['id'], 0755, true);
        if(file_exists($path.'/'.$product['id']."/information.blade.php")) {

            file_put_contents($path.'/'.$product['id']."/information.blade.php", $this->information);
        }

        //DB::table('shop_products')->where('id', $this->_id)->update($this->forms);
        $this->_id = null;
        $this->popup = false;
    }

}
