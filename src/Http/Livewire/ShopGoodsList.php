<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\On;


class ShopGoodsList extends Component
{
    use WithPagination;

    public $cate;
    public $cate_id;
    public $category = [];

    public $display = "grid"; // "list"

    public $sorting;
    public $paging = 16;

    public $cartidx; // 카트번호

    public $viewGrid;
    public $viewList;
    public $viewCell;

    public $filters = [];
    public $options = [];

    public $foundItems;

    public function mount()
    {
        // 그리드 화면 주입
        if(!$this->viewGrid) {
            $this->viewGrid = "jiny-shop-goods::goods.grid";
        }

        // 리스트 화면 주입
        if(!$this->viewList) {
            $this->viewList = 'jiny-shop-goods::goods.list';
        }

        // 단위셀 화면주입
        if(!$this->viewCell) {
            $this->viewCell = "www::shop_fashion-v1._partials.goods.cell";
        }

        // 카테고리 코드 확인
        if($cate = $this->getCeteCode()) {
            $this->cate = $cate;
            $rows = DB::table('shop_categories')
                ->where('name',$cate)
                ->first();

            if($rows) {
                $this->category = [];
                foreach($rows as $key => $value) {
                    $this->category[$key] = $value;
                }
            }
        }

        // 장바구니 카트번호 확인
        if($cartidx = $this->checkUserCartIdx()) {
            $this->cartidx = $cartidx;
        } else {
            $this->cartidx = $this->generateUniqueCartId();
        }

        //

    }

    ## 화면 렌더링
    public function render()
    {
        // 화면 타입 반환
        $viewFile = $this->getViewFile($this->paging);

        return view($viewFile,[
            'products'=>$this->fetch($this->paging)
        ]);
    }

    ## 데이터 읽기
    private function fetch($paging)
    {
        $db = DB::table('shop_goods');

        // 카테고리 상품 검색
        $db = $this->checkCategory($db);

        // 조건필터 추가
        $db = $this->checkFilters($db);

        // 옵션 필터링
        $db = $this->checkOptions($db);




        // 정렬방식 선택
        $db = $this->checkSorting($db);

        // found Items
        $this->foundItems = $db->count();

        return $db->paginate($paging);
    }

    private function checkCategory($db)
    {
        if($this->cate) {
            $db->where('category', 'like', '%'.$this->cate.';%');
        }
        return $db;
    }

    ## uri에서 카테고리 검사
    private function getCeteCode()
    {
        $current_url = Request::url();
        $urls = array_reverse(explode('/',$current_url));

        // 계시판 코드 추출
        if(isset($urls[0]) && is_string($urls[0])) {
            if($urls[0] != "goods") {
                return $urls[0];
            }
        }

        return false;
    }

    private function checkOptions($db)
    {
        if($this->options) {
            foreach($this->options as $key => $option) {
                foreach($option as $value) {
                    if($value) {
                        $db->orWhere('option', 'like', '%'.$value.';%');
                    }
                }
            }
        }

        return $db;
    }

    private function checkSorting($db)
    {
        if($this->sorting) {
            $sort = explode(':',$this->sorting);

            if(isset($sort[0]) && $sort[0]) {
                if(isset($sort[1]) && $sort[1]) {
                    $db->orderBy($sort[0], $sort[1]);
                }
            }
        }

        return $db;
    }

    private function checkFilters($db)
    {
        if($this->filters) {
            foreach($this->filters as $key => $filter) {
                // > 또는 < 시작하는 키의 경우 range 처리
                if(in_array($key[0], ['<','>'])) {

                    // 인식키 제거
                    $field = trim($key,'<');
                    $field = trim($key,'>');

                    if(isset($filter['range1']) && $filter['range1']) {
                        $db->where($field ,'>=', $filter['range1']);
                    }

                    if(isset($filter['range2']) && $filter['range2']) {
                        $db->where($field ,'<=', $filter['range2']);
                    }

                }
                // %로 시작하는 경우 like로 처리
                else if($key[0] == '%') {
                    $field = trim($key,'%');
                    foreach($filter as $value) {
                        if($value) {
                            $db->orWhere($field, 'like', '%'.$value.';%');
                        }
                    }
                }
                // or 일치조건
                else if($key[0] == '!') {
                    $field = trim($key,'!');
                    foreach($filter as $value) {
                        if($value) {
                            $db->orWhere($field, $value);
                        }
                    }
                }
                // 일반 컬럼명 일경우 == 일치 조건
                else {
                    // $filer가 빈 배열이 아는 경우에만 처리
                    if($filter) {
                        $db->whereIn($key, $filter);
                    }
                }
            }
        }

        return $db;
    }

    private function getCategory($category_id)
    {
        // 카테고리
        $row = DB::table('shop_product_categories')
            ->where('category_id', $category_id)
            ->first();
        return $row;
    }

    private function getViewFile()
    {
        if($this->display == "list") {
            return $this->viewList;
        } else {
            return $this->viewGrid;
        }
    }


    public function displayGrid()
    {
        $this->display = "grid";
    }

    public function displayList()
    {
        $this->display = "list";
    }

    #[On('reflash')]
    public function reflash()
    {
        // 이벤트로 화면을 갱신합니다.
    }


    /**
     * 상품 overlay 버튼 처리
     */
    ## 관심상품 등록
    public function addWish($id)
    {
        // 관심 상품은 회원 로그인한 경우에만 처리
        if(Auth::check()) {
            $email = Auth::user()->email;

            // 카트 갯수
            session()->increment('wish');

            // 신규상품 등록
            $product = DB::table('shop_goods')->where('id',$id)->first();

            if(!$product->name) {
                $product->name = "temp";
            }

            $data = [
                'email'=>$email,
                'product_id'=>$product->id,
                'product'=>$product->name,
                'image'=>$product->image,
                'price'=>$product->sale_price
            ];
            DB::table('shop_wish')->insert($data);

            // wish 컴포넌트 갱신
            //$this->emit('refreshComponent');
            $this->dispatch('refreshComponent');
        }
    }

    ## 장바구니
    //public $popupCart = false;
    public function addCart($product_id, $product_name, $product_price)
    {

        if($this->cartidx) {

            // cart목록에 상품이 존재하는지 확인
            $cart = DB::table('shop_cart')
                ->where('cartidx',$this->cartidx)
                ->where('product_id',$product_id)
                ->first();


            if($cart) {
                // 장바구니 존재 : 상품 갯수를 1개 증가
                DB::table('shop_cart')
                ->where('cartidx',$this->cartidx)
                ->where('product_id',$product_id)->increment('quantity');

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

                if(Auth::check()) {
                    $email = Auth::user()->email;
                    $data['email'] = $email;
                }

                DB::table('shop_cart')->insert($data);
            }
        }

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

    // public function popupCartOpen()
    // {
    //     $this->popupCart = true;
    // }

    // public function popupCartClose()
    // {
    //     $this->popupCart = false;
    // }

    /**
     * 검색 필터와 통신을 위한 이벤트
     */
    protected $listeners = [
        'setFilter', 'setOptions'
    ];

    public function setFilter($value)
    {
        foreach($value as $key => $item) {
            $this->filters[$key] = $item;
        }

    }

    public function setOptions($value)
    {
        foreach($value as $key => $item) {
            $this->options[$key] = $item;
        }

    }

}
