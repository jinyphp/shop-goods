<?php

namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

//use Webuni\FrontMatter\FrontMatter;
//use Jiny\Pages\Http\Parsedown;

use Livewire\WithPagination;
//use Jiny\Shop\Entities\ShopProducts;
//use Jiny\Shop\Entities\ShopCategory as Category;
//use Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;


class ShopProductList extends Component
{
    use WithPagination;

    public $cate;
    public $display = "grid"; // "list"

    public $sorting;
    public $pagesize;
    //public $slug;
    public $category_id;
    public $cate_id;

    public $cartidx; // 카트번호

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
    }

    public function render()
    {
        $category_id = $this->category_id;
        $paging = 16;

        // dump($category_id);

        // 카테고리 상품 검색
        if($category_id) {
            // 카테고리 상품
            $rows = DB::table('shop_product_categories')
                ->where('category_id', $category_id)->get();

            $ids = [];
            foreach($rows as $row) {
                $ids []= $row->product_id;
            }

            $db = DB::table('shop_products')->whereIn('id',$ids);
        } else {
            // 전체상품
            $db = DB::table('shop_products');
        }

        // dump($rows);
        // dd($db);

        if($this->sorting == "date") {
            $db->orderBy('created_at',"DESC");
        } else
        if($this->sorting == "price") {
            $db->orderBy('regular_price',"ASC");
        } else
        if($this->sorting == "price-desc") {
            $db->orderBy('regular_price',"DESC");
        }

        $products = $db->paginate($paging);


        $viewFile = $this->getViewFile();
        // dump($products);
        return view($viewFile,[
            'products'=>$products
        ]);
    }


    private function getViewFile()
    {
        if($this->display == "list") {
            return 'jiny-shop-goods::products.list';
        } else {
            return 'jiny-shop-goods::products.grid';
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
     * 장바구니
     */
    public $popupCart = false;

    public function addCart($product_id, $product_name, $product_price)
    {
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

    /**
     * 관심상품 등록
     */
    public function addWish($id)
    {
        if(Auth::check()) {
            $email = Auth::user()->email;

            // 카트 갯수
            session()->increment('wish');

            // 신규상품 등록
            $product = DB::table('shop_products')->where('id',$id)->first();
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
}
