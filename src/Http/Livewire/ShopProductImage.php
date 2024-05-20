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
use Livewire\WithFileUploads;

class ShopProductImage extends Component
{
    use WithFileUploads;

    public $product;

    public function render()
    {
        $pos = strrpos($this->product['image'],"/");
        $alt = substr($this->product['image'],$pos+1);

        $media = DB::table('shop_product_images')
            ->where('product_id',$this->product['id'])->get();

        return view('jiny-shop-goods::detail.widget_images',[
            'media'=>$media,
            'product'=>$this->product,
            'alt'=>$alt
        ]);
    }

    protected $listeners = ['reflashPopup'];
    public function reflashPopup()
    {

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

        $row = DB::table('shop_products')->where('id', $id)->first();
        $this->forms = [];
        foreach($row as $key => $value) {
            $this->forms[$key] = $value;
        }

    }

    public function update()
    {
        $this->_id = null;
        $this->popup = false;

        // public or private 저장영역 설정
        /*
        if(isset($this->actions['visible'])) {
            $visible = $this->actions['visible'];
        } else {
            $visible = "private";
        }
        */

        /*
        $appPath = storage_path('app/'.$visible);
        $path = $appPath.DIRECTORY_SEPARATOR.$upload_directory;
        if(!\is_dir($path)) {
            \mkdir($path, 755, true);
        }
        */

        foreach($this->forms as $key => $item) {
            if($item instanceof \Livewire\TemporaryUploadedFile) {
                $item->store('shop');
                /*
                $filename = $item->store($upload_directory, $visible);
                $this->forms[$key] = $visible."/".$filename;

                // uploadfile 테이블에 기록
                DB::table('uploadfile')->updateOrInsert([
                    'table' => $this->actions['table'],
                    'field' => $key
                ]);
                */

            }
        }

        //DB::table('shop_products')->where('id', $this->_id)->update($this->forms);
    }

    public function delete($id)
    {
        if($id==0) {
            // 메인 이미지
        } else {
            // 서브이미지
            $row = DB::table('shop_product_images')->where('id', $id)->first();
            if($row) {
                $path = public_path();
                unlink($path."".$row->image);
                DB::table('shop_product_images')->where('id', $id)->delete();
            }
        }
    }


}
