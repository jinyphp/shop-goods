<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\On;

class ShopDetailOption extends Component
{
    use WithFileUploads; // 옵션 이미지 등록

    public $actions = [];
    public $slug;


    public $viewFile;

    public $popupForm = false;
    public $forms = []; // 상품의 정보



    // 라이브와이어 생성자
    public function mount()
    {
        // $this->qty = 1;
        //$this->viewListFile();
        //$this->viewFormFile();

        if(!$this->viewFile) {
            $this->viewFile = "jiny-shop-goods::detail_v2.option";
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

    /**
     * 이벤트
     */
    protected $listeners = [
        'requestOptionCart' => 'getOptionCart'
    ];

    public function getOptionCart()
    {
        // dump("getOptionItem");
        // Dispatch an event back to the first component with the cart item data
        $this->dispatch('updatedOptionItem', $this->optForms);
    }

}
