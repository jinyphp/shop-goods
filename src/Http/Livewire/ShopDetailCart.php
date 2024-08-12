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

class ShopDetailCart extends Component
{
    use WithFileUploads; // 옵션 이미지 등록

    public $actions = [];
    public $slug;
    public $qty;

    public $viewFile;

    public $popupForm = false;
    public $forms = []; // 상품의 정보

    public $message;


    // 라이브와이어 생성자
    public function mount()
    {
        $this->qty = 1;

        if(!$this->viewFile) {
            $this->viewFile = "jiny-shop-goods::detail_v2.cart";
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


    public function render()
    {
        if($this->popupForm) {
            return view($this->viewFile."_edit", []);
        }

        return view($this->viewFile, []);
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


    private function fetchGoods($id)
    {
        return DB::table('shop_goods')
                ->where('id',$id)
                ->first();
    }

    /**
     * 관심상품
     */
    public function wish()
    {
        $product_id = $this->forms['id'];

        if(Auth::check()) {

            // 상품정보 다시 읽기
            ## 수정으로 데이터값이 변경여부 반영하기 위함
            $goods = $this->fetchGoods($product_id);
            $this->saveWish($goods);

            // wish 컴포넌트 갱신
            // $this->emit('refreshComponent');

        }
    }

    // wish 데이터 포맷으로 변경하여 저장
    private function saveWish($goods)
    {
        $email = Auth::user()->email;

        // 카트 갯수
        session()->increment('wish');

        $row = DB::table('shop_wish')
            ->where('email', $email)
            ->where('product_id', $goods->id)
            ->first();

        if($row) { // 중복상품 등록 방지
            //$this->message = "wish 목록에 등록된 상품입니다.";
            session()->flash('detail_message',"wish 목록에 등록된 상품입니다.");
        } else {
            $wish = [
                'email'=>$email,
                'product_id'=>$goods->id,
                'product'=>$goods->name,
                'image'=>$goods->image
            ];

            //dd($wish);
            DB::table('shop_wish')->insert($wish);
        }

    }

    /**
     * 이벤트
     */
    protected $listeners = [
        'updatedOptionItem'
    ];
    public $eventType;

    ## option 정보를 수신합니다.
    public function updatedOptionItem($value)
    {
        // 수신받은 옵션 저장
        $this->optForms = $value;

        // 라이브와이어 통신에 약간의 시간이 필요
        // 동기방식으로, option 값을 읽어온 후에 실행
        //dd($this->eventType);
        if($this->eventType == "cart") {
            $this->callbackCart();

        } else if($this->eventType == "order") {
            $this->callbackOrder();
        }

    }

    /**
     * 장바구니
     */
    // 장바구니
    public $cartidx; // 카트번호
    public $optForms;

    public function addCart()
    {
        $this->eventType = "cart";

        // 다른 라이브와이어에게
        // option 설정 정보를 요청합니다.
        $this->dispatch('requestOptionCart');

    }

    private function callbackCart()
    {
        // 장바구니 카트번호 확인
        if($cartidx = $this->checkUserCartIdx()) {
            $this->cartidx = $cartidx;
        } else {
            $this->cartidx = $this->generateUniqueCartId();
        }

        // dd($this->cartidx);
        $product_id = $this->forms['id'];
        if($this->cartidx) {

            // 옵션 시리얼라이징
            $options = "";
            foreach($this->optForms as $type => $opt) {
                $options .= $type.":".$opt.";";
            }

            // cart목록에 상품이 존재하는지 확인
            $cart = DB::table('shop_cart')
                ->where('cartidx', $this->cartidx)
                ->where('option', $options) // 옵션까지 같이 검색
                ->where('product_id', $product_id)->first();

            if($cart) {
                // 장바구니 존재 : 상품 갯수를 1개 증가
                $this->increaseCartItem($product_id);

            } else {
                // 카트 갯수
                session()->increment('cart');

                $this->saveCart($product_id, $options);
            }
        }

        //dd($data);
        // $this->popupCartOpen();
    }

    private function saveCart($product_id, $options=null)
    {
        // 신규상품 등록
        $product = DB::table('shop_goods')
            ->where('id',$product_id)
            ->first();

        if($product) {
            $data = [
                'cartidx'=>$this->cartidx,
                'product_id'=>$product->id,
                'product'=>$product->name,
                'image'=>$product->image,
                'price'=>$product->price,
                'option' => $options
            ];

            if(Auth::check()) {
                $email = Auth::user()->email;
                $data['email'] = $email;
            }

            DB::table('shop_cart')->insert($data);
        }
    }

    private function increaseCartItem($product_id)
    {
        DB::table('shop_cart')
                ->where('cartidx', $this->cartidx)
                ->where('product_id', $product_id)->increment('quantity');

        session()->flash('detail_message',"등록된 상품입니다. 수량을 증가합니다.");
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
     * 바로 주문
     */
    public function orderNow()
    {
        $this->eventType = "order";
        $this->dispatch('requestOptionCart');

        //dd("orderNow");
    }


    public function callbackOrder()
    {
        $product_id = $this->forms['id'];

        // dd("callbackOrder");

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
        if($product) {
            // 옵션 시리얼라이징
            $options = "";
            foreach($this->optForms as $type => $opt) {
                $options .= $type.":".$opt.";";
            }

            $checkout = [
                'orderidx'=>$order_idx,
                'product_id'=>$product->id,
                'product'=>$product->name,
                'image'=>$product->image,
                'price'=>$product->price,
                'options' => $options
            ];

            // 날짜 정보
            $checkout['created_at'] = date("Y-m-d H:i:s");
            $checkout['updated_at'] = $checkout['created_at'];

            // 옵션
            //$checkout['options'] = json_encode($this->option);

            if(Auth::check()) {
                $email = Auth::user()->email;
                $checkout['email'] = $email;
            }

            DB::table('shop_checkout_items')->insert($checkout);

        }
    }



}
