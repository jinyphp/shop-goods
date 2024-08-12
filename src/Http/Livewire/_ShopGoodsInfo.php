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
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\On;

class ShopGoodsInfo extends Component
{
    use WithFileUploads; // 옵션 이미지 등록

    public $actions = [];
    public $slug;
    public $qty;

    public $viewFile;

    public $popupForm = false;
    public $forms = []; // 상품의 정보



    // 라이브와이어 생성자
    public function mount()
    {
        $this->qty = 1;
        //$this->viewListFile();
        //$this->viewFormFile();

        if(!$this->viewFile) {
            $this->viewFile = "jiny-shop-goods::detail_v2.info";
        }


        // 인자로 slug가 없는 경우, uri를 분석
        if(!$this->slug) {
            $current_url = Request::url();
            $urls = array_reverse(explode('/',$current_url));

            // 코드 추출
            if(isset($urls[0]) && is_string($urls[0])) {
                $slug = $urls[0];
                $this->slug = $urls[0];
            }
        } else {
            $slug = $this->slug;
        }


        if (is_numeric($slug)) {
            $goods = DB::table('shop_goods')
                ->where('id',$slug)->first();
        }  else {
            $goods = DB::table('shop_goods')
                ->where('slug',$slug)->first();
        }

        // 객체를 배열로 변환
        foreach($goods as $key => $value) {
            $this->forms[$key] = $value;
        }

        //
        if($goods) {
            $options = DB::table('shop_goods_option')
            ->where('goods_id',$this->forms['id'])
            ->get();

            //dd($options);

            $this->options = [];
            foreach($options as $item) {
                $key = $item->type;

                $temp = [];
                foreach($item as $i => $v) {
                    $temp[$i] = $v;
                }

                $this->options[$key] []= $temp;

                //$this->options[$key] []= $item;
            }

            //dd($this->options);
        }


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

    public function render()
    {
        if($this->popupForm) {
            return view($this->viewFile."_edit", []);
        }

        return view($this->viewFile, []);
    }


    public function cancel()
    {
        $this->setup = false;
        $this->popupForm = false;
    }

    ## 수정 편집
    public function modify()
    {
        $this->popupForm = true;
    }

    ## 수정 데이터 갱신
    public function update()
    {
        $id = $this->forms['id'];

        DB::table('shop_goods')
            ->where('id', $id)
            ->update($this->forms);

        $this->popupForm = false;
    }

    /**
     * 장바구니
     */
    // 장바구니
    public $cartidx; // 카트번호
    // public $popupCart = false;

    public function addCart()
    {
        //dd($this->optForms);

        // 장바구니 카트번호 확인
        if($cartidx = $this->checkUserCartIdx()) {
            $this->cartidx = $cartidx;
        } else {
            $this->cartidx = $this->generateUniqueCartId();
        }

        // dd($this->cartidx);
        $product_id = $this->forms['id'];
        if($this->cartidx) {

            // cart목록에 상품이 존재하는지 확인
            $cart = DB::table('shop_cart')
                ->where('cartidx', $this->cartidx)
                ->where('product_id', $product_id)->first();

            if($cart) {
                // 장바구니 존재 : 상품 갯수를 1개 증가
                DB::table('shop_cart')
                ->where('cartidx', $this->cartidx)
                ->where('product_id', $product_id)->increment('quantity');

            } else {
                // 카트 갯수
                session()->increment('cart');

                // 신규상품 등록
                $product = DB::table('shop_goods')
                    ->where('id',$product_id)
                    ->first();
                $data = [
                    'cartidx'=>$this->cartidx,
                    'product_id'=>$product->id,
                    'product'=>$product->name,
                    'image'=>$product->image,
                    'price'=>$product->price
                ];

                // 옵션
                $data['option'] = "";
                foreach($this->optForms as $type => $opt) {
                    $data['option'] .= $type.":".$opt.";";
                    // foreach($opt as $item) {
                    //     $data['option'] .= $type.":".$item.";";
                    // }
                }

                //implode(';',$this->optForms).";";// ""; //$this->option;

                if(Auth::check()) {
                    $email = Auth::user()->email;
                    $data['email'] = $email;
                }

                DB::table('shop_cart')->insert($data);
            }
        }

        //dd($data);
        // $this->popupCartOpen();
    }

    private function checkUserCartIdx()
    {
        // 회원 인증여부 체크
        if($user = Auth::user()) {
            // 이전에 장바구니가 있는 경우 확인
            $check = DB::table('shop_cart')
                ->where('email',$user->email)
                ->orderBy('id',"desc") // 가장 최신
                ->first();

            if($check) {
                // 카트번호 저장
                return $check->cartidx;
            }
        }
    }

    private function generateUniqueCartId()
    {
        // 고유의 ID를 생성
        $id = uniqid(mt_rand(), true);
        $code = substr(hash('sha256',$id),0,15); // 10자리 추출
        return date("Ymd-his")."-".$code;
    }

    /**
     * 관심상품
     */
    public function wish()
    {
        $product_id = $this->forms['id'];

        if(Auth::check()) {
            $email = Auth::user()->email;

            // 카트 갯수
            session()->increment('wish');

            // 신규상품 등록
            $product = DB::table('shop_goods')
                ->where('id',$product_id)
                ->first();
            $data = [
                'email'=>$email,
                'product_id'=>$product->id,
                'product'=>$product->name,
                'image'=>$product->image
            ];

            DB::table('shop_wish')->insert($data);

            // wish 컴포넌트 갱신
            // $this->emit('refreshComponent');

        }
    }

    /**
     * 바로 주문
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
        $product = DB::table('shop_goods')
            ->where('id',$product_id)
            ->first();
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

    /**
     * 옵션처리
     */
    public $options = [];
    public $optForms = [];
    public $newOption = false;
    public $optionKey;
    public function optionCreate()
    {
        $this->newOption = true;
        $this->optionKey = null;
    }

    public function optionStore()
    {
        $key = $this->optionKey;
        $this->options[$key] = [];

        $this->newOption = false;
        $this->optionKey = null;
    }

    public function optionCancel()
    {
        $this->newOption = false;
        $this->optionKey = null;
    }

    public $newOptionItem = false;
    public $optionItem = [];
    public $optionImage;
    public function optionAddItem($key)
    {
        $this->newOptionItem = $key;
        $this->optionItem = [];


    }

    public function optionItemStore($key)
    {
        if($this->optionItem) {
            $this->options[$key] []= $this->optionItem;

            // 옵션 이미지 처리
            $this->optionImage=null;

            $source = storage_path('app');
            $source .= DIRECTORY_SEPARATOR;
            $source .= $this->optionItem['image']->store('uploads/goods/option');

            $extension = strtolower(substr(strrchr($source,"."),1));

            $target = public_path();
            $subPath = "/images/goods";
            $subPath .= "/".date("Y/m/d"); // 날짜 경로를 추가함
            $subPath = str_replace(["/","\\"],DIRECTORY_SEPARATOR,$subPath);
            //dump($target);
            if(!is_dir($target.$subPath)) {
                mkdir($target.$subPath, 755, true);
            }

            // 이미지 파일 /public/~ 으로 이동
            $filename = $this->forms['id']."-".
                $key."-".
                $this->optionItem['name'].
                ".".$extension;

            rename($source,
                $target.$subPath.DIRECTORY_SEPARATOR.$filename
            );

            $this->optionImage = $subPath.DIRECTORY_SEPARATOR.$filename;

            DB::table('shop_goods_option')->insert([
                'goods_id' => $this->forms['id'],
                'type' => $key,
                'name' => $this->optionItem['name'],
                'image' => $this->optionImage
            ]);
        }


        $this->newOptionItem = false;
        $this->optionItem = [];
    }

    public function optionItemCancel()
    {
        $this->newOptionItem = false;
        $this->optionItem = [];
    }

    public function optionRemoveItem($key, $opt)
    {
        foreach($this->options[$key] as $i => $value) {
            if($value['name'] == $opt) {
                unset($this->options[$key][$i]);

                DB::table('shop_goods_option')
                    ->where('goods_id', $this->forms['id'])
                    ->where('type', $key)
                    ->where('name', $opt)
                    ->delete();
            }
        }
    }





}
