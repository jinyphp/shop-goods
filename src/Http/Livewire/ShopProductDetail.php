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
use Illuminate\Support\Facades\Auth;

use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class ShopProductDetail extends Component
{
    use WithFileUploads;
    use \Jiny\WireTable\Http\Trait\Upload;

    public $actions = [];
    public $widget=[]; // 위젯정보

    // public $product = []; //상품정보
    public $slug;
    public $qty;

    public $option=[];

    public $productOptions=[];

    public $edit_id;
    public $forms=[];

    public $popupForm = false;
    public $viewForm;
    public $viewList;
    public $viewListItem;

    public $popupDelete = false;
    public $confirm = false;

    public $upload_path;

    use \Jiny\Widgets\Http\Trait\DesignMode;

    public $setup = false;
    public function setting()
    {
        $this->popupForm = true;
        $this->setup = true;
    }

    // 라이브와이어 생성자
    public function mount()
    {
        $this->qty = 1;
        $this->viewListFile();
        $this->viewFormFile();
    }

    public function render()
    {

        $slug = $this->slug;
        if (is_numeric($slug)) {
            $product = DB::table('shop_products')
                ->where('id',$slug)->first();
            //$product = ShopProducts::where('id',$slug)->first();
        } else {
            //$product = ShopProducts::where('slug',$slug)->first();
            $product = DB::table('shop_products')
                ->where('slug',$slug)->first();
        }

        // dump($product);

        // 객체를 배열로 변환
        foreach($product as $key => $value) {
            $this->forms[$key] = $value;
        }

        // dd($this->forms);


        // // 옵션설정
        // if($product->option) {
        //     $options = $this->options($product->id);
        // } else {
        //     $options = null;
        // }

        // // 배송정보
        // $shipping = DB::table('shop_shipping_method')->where('enable',1)->get();

        $viewFile = 'jiny-shop-goods::detail.widget';
        return view($viewFile, [
            // 'slug'=>$this->slug

            'product'=>$product,
            // 'shipping'=>$shipping,
            // 'options'=>$options,
            // 'optiontree' => $this->optionTree($options,"option")->addClass("option")
        ]);
    }


    private function viewListFile()
    {
        $viewFile = 'jiny-shop-goods::detail.detail';

        if(isset($this->widget['view']['list'])) {
            $viewFile = $this->widget['view']['list'];
        }

        $this->viewList = $viewFile;
        return $viewFile;
    }

    private function viewFormFile()
    {
        $this->viewForm = 'jiny-shop-goods::detail.detail_form';

        if(isset($this->widget['view']['form'])) {
            $this->viewForm = $this->widget['view']['form'];
        }

        return $this->viewForm;
    }


    protected $listeners = [
        'create','popupFormCreate',
        'edit','popupEdit','popupCreate'
    ];

    public function cancel()
    {
        //$this->forms = [];
        $this->setup = false;
        $this->popupForm = false;
    }

    public function modify()
    {
        $this->popupForm = true;
        //dd($this->forms);
    }

    public function update()
    {
        $id = $this->forms['id'];
        DB::table('shop_products')
            ->where('id', $id)
            ->update($this->forms);

        $this->popupForm = false;
    }












    private function optionTree($options, $name=null)
    {
        $tree = new CTag('ul',true);
        if(is_array($options)) {
            foreach($options as $i => $option) {
                $title = new CTag('li',true);

                $title->addItem(
                    (new Ctag('span',true))->addItem($option->name)->addClass("font-bold")
                );

                $ul = $this->optionItems($option->id, $name);

                $title->addItem($ul);
                $tree->addItem($title);
            }
        }

        return $tree;
    }

    private function optionItems($option_id, $name=null)
    {
        // 아이템목록
        $ul = new CTag('ul',true);
        $ul->addClass("ml-4");
        $items = $this->getOptionItem($option_id);
        $name .= "[".$option_id."]";
        foreach($items as $i => $item) {
            //$index = $level.$i."-";
            //$index = "";

            $radio = $this->optionRadio($item, $name);

            if($item->nested) {
                $rows = DB::table('shop_options')->where('id',$item->nested)->get();
                $radio->addItem($this->optionTree($rows, $name));
            }

            $ul->addItem($radio);
        }

        return $ul;
    }

    private function optionRadio($item, $name=null)
    {
        $radio = (new Ctag('input',false))->setAttribute('type',"radio");
        //$radio->setAttribute('name', "option[".$item->option_id."]");
        $radio->setAttribute('name', $name);
        $radio->setAttribute('value', $item->id);

        //$radio->setAttribute('wire:model.defer', "option.".$item->id);
        $model = str_replace('[','.',$name);
        $model = str_replace(']','',$model);
        $radio->setAttribute('wire:model.defer', $model.".item");

        //$label = (new Ctag('label',false))->addItem($item->name);
        $label = $item->name;

        $li = new CTag('li',true);
        $li->addItem($label)->addItem($radio);
        return $li;
    }



    private function options($product_id)
    {
        // 복수의 옵션 선택 가능
        $rows = DB::table('shop_products_option')->where('product_id',$product_id)->get();


        $Options = [];
        foreach($rows as $i => $opt) {
            $oid = $opt->option_id;
            $Options[$i] = DB::table('shop_options')->where('id',$oid)->first();

            $items = $this->getOptionItem($oid);
            $Options[$i]->items = $items; //['items'] = [];

        }

        return $Options;
    }

    private $_option_item=[];
    private function getOptionItem($oid)
    {
        if(isset($this->_option_item[$oid])) {
            // 이전 저장된값 반환
        } else {
            $this->_option_item[$oid] = DB::table('shop_options_item')
            ->where('option_id',$oid)
            ->get();
        }
        return $this->_option_item[$oid];
    }



    // 장바구니
    public $cartidx; // 카트번호
    public $popupCart = false;

    public function store($product_id)
    {
        //dd($this->option);

        if($this->cartidx) {

            // cart목록에 상품이 존재하는지 확인
            $cart = DB::table('shop_cart')
                ->where('cartidx',$this->cartidx)
                ->where('product_id',$product_id)->first();

            if($cart) {
                // 장바구니 존재 : 상품 갯수를 1개 증가
                DB::table('shop_cart')
                ->where('cartidx',$this->cartidx)
                ->where('product_id',$product_id)->increment('quantity');

            } else {
                // 카트 갯수
                session()->increment('cart');

                // 신규상품 등록
                $product = DB::table('shop_products')->where('id',$product_id)->first();
                $data = [
                    'cartidx'=>$this->cartidx,
                    'product_id'=>$product->id,
                    'product'=>$product->name,
                    'image'=>$product->image,
                    'price'=>$product->sale_price
                ];

                // 옵션
                $data['option'] = $this->option;

                if(Auth::check()) {
                    $email = Auth::user()->email;
                    $data['email'] = $email;
                }

                DB::table('shop_cart')->insert($data);
            }
        }

        $this->popupCartOpen();
    }

    public function popupCartOpen()
    {
        $this->popupCart = true;
    }

    public function popupCartClose()
    {
        $this->popupCart = false;
    }

    public function increaseQuantity()
    {
        $this->qty++;
    }

    public function decreaseQuantity()
    {
        // 수량 하한선
        if($this->qty>1) {
            $this->qty--;
        }
    }


    /**
     * Popup Admin
     */
    public $admin;
    public $popup = false;

    public $_id;

    public function edit($id)
    {
        $this->_id = $id;
        $this->popup = true;
        $row = DB::table('shop_products')->where('id', $id)->first();
        $this->forms = [];
        foreach($row as $key => $value) {
            $this->forms[$key] = $value;
        }
    }



    /**
     * 관심상품
     */
    public function wish($product_id)
    {
        if(Auth::check()) {
            $email = Auth::user()->email;

            // 카트 갯수
            session()->increment('wish');

            // 신규상품 등록
            $product = DB::table('shop_products')->where('id',$product_id)->first();
            $data = [
                'email'=>$email,
                'product_id'=>$product->id,
                'product'=>$product->name,
                'image'=>$product->image
            ];

            DB::table('shop_wish')->insert($data);

            // wish 컴포넌트 갱신
            $this->emit('refreshComponent');

        }
    }


    /**
     * 옵션설정 관리
     */
    /*
    public $popupOptionSetting=false;

    public $optionList=[];
    public $product_id;
    public function openOptionSetting($id)
    {
        $this->product_id = $id;

        // 상품옵션
        $rows = DB::table('shop_products_option')->where('product_id',$id)->get();
        foreach($rows as $row) {
            $this->productOptions []= $row->option_id;
        }


        // 옵션목록
        $this->optionList = DB::table('shop_options')->get();


        //$this->productOptions = $rows;
        $this->popupOptionSetting=true;
    }

    public function closeOptionSetting()
    {
        $this->popupOptionSetting=false;
    }

    public function addOption($option_id)
    {
        $row = DB::table('shop_products_option')
            ->where('product_id',$this->product_id)
            ->where('option_id',$option_id)
            ->first();

        if($row) {
            // 중복 저장
        } else {
            DB::table('shop_products_option')->insert([
                'product_id'=>$this->product_id,
                'option_id'=>$option_id
            ]);
        }
    }

    public function removeOption($option_id)
    {

    }
    */



    public function orderNow($product_id)
    {
        if (session()->has('orderidx')) {
            // 서버 세션값 이용
            $order_idx = session()->get('orderidx');
            $order_status = "checkout";
        } else {
            // orderidx 생성
            $str = md5(microtime().mt_rand(1000,2000));
            $order_idx = date("Ymd")."_".substr($str,0,21); //30자
            $order_status = "checkout";

            // 세션 생성
            session()->put('orderidx', $order_idx);
        }

        // 신규상품 등록
        $product = DB::table('shop_products')->where('id',$product_id)->first();
        $checkout = [
            'orderidx'=>$order_idx,
            'product_id'=>$product->id,
            'product'=>$product->name,
            'image'=>$product->image,
            'price'=>$product->sale_price
        ];

        // 날짜 정보
        $checkout['created_at'] = date("Y-m-d H:i:s");
        $checkout['updated_at'] = $checkout['created_at'];

        // 옵션
        $checkout['options'] = json_encode($this->option);

        if(Auth::check()) {
            $email = Auth::user()->email;
            $checkout['email'] = $email;
        }

        DB::table('shop_checkout_items')->insert($checkout);

    }
}
