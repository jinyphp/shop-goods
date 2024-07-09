<?php

namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Webuni\FrontMatter\FrontMatter;
use Jiny\Pages\Http\Parsedown;

use \Jiny\Html\CTag;

use Jiny\Shop\Entities\ShopSliders;

use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class ShopBrands extends Component
{
    use WithFileUploads;
    use \Jiny\WireTable\Http\Trait\Upload;

    public $actions = [];
    public $widget=[]; // 위젯정보

    public $post_id;
    public $edit_id;
    public $rows = [];
    public $last_id;

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

    public $tablename = "shop_brands";

    public function mount()
    {
        $this->reply_id = 0;
        $this->viewListFile();
        $this->viewFormFile();

        //
        $this->upload_path = "/".$this->tablename;
    }


    public function render()
    {
        // DB에서 데이터를 읽어 옵니다.
        $rows = DB::table("shop_brands")
                //->where('code',$this->code)
                //->orderBy('level',"desc")
                ->get();

        $this->rows = [];
        foreach($rows as $item) {
            $id = $item->id;
            $this->rows[$id] = get_object_vars($item); // 객체를 배열로 변환
        }

        // dd($rows);

        $viewFile = 'jiny-shop-goods::brand.widget';
        return view($viewFile,['brands'=>$rows]);
    }

    private function viewListFile()
    {
        $viewFile = 'jiny-shop-goods::brand.list';

        if(isset($this->widget['view']['list'])) {
            $viewFile = $this->widget['view']['list'];
        }

        $this->viewList = $viewFile;
        return $viewFile;
    }

    private function viewFormFile()
    {
        $this->viewForm = 'jiny-shop-goods::brand.form';

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
        $this->forms = [];
        //$this->editmode = null;
        //$this->reply_id = null;
        //$this->edit_id = null;
        $this->setup = false;

        $this->popupForm = false;
    }

    public function create()
    {
        $this->popupForm = true;
        $this->edit_id = null;

        // 데이터초기화
        $this->forms = [];
        //$this->forms['code'] = $this->code;
    }

    public function store()
    {
        /*
        if($this->reply_id) {
            $this->forms['ref'] = $this->reply_id;

            $id = $this->reply_id;
            $this->forms['level'] = $this->level + 1;
        } else {
            $this->forms['ref'] = 0;
            $this->forms['level'] = 1;
        }
        */

        // 3. 파일 업로드 체크 Trait
        $this->fileUpload($this->forms, $this->upload_path);


        // 2. 시간정보 생성
        $this->forms['created_at'] = date("Y-m-d H:i:s");
        $this->forms['updated_at'] = date("Y-m-d H:i:s");

        $form = $this->forms;

        $id = DB::table("shop_brands")->insertGetId($form);
        $form['id'] = $id;
        $this->last_id = $id;

        $this->forms = []; // 초기화
        $this->reply_id = null;
        $this->level = null;

        $this->popupForm = false;
        $this->edit_id = null;
    }

    public $reply_id;
    public $level;
    public function reply($id, $level)
    {
        $this->reply_id = $id;
        $this->level = $level;

        // 데이터초기화
        $this->forms = [];
        //$this->forms['code'] = $this->code;

        $this->popupForm = true;
    }

    public $editmode=null;
    public function edit($id)
    {
        $this->editmode = "edit";
        $this->reply_id = $id;

        $this->forms = $this->rows[$id];

        $this->edit_id = $id;
        $this->popupForm = true;
    }

    public function update()
    {
        // 수정폼에서 하위메뉴가 있는경우,
        // 하위메뉴는 DB삽입이 되지 않기 때문에 삭제함
        if(isset($this->forms['items'])) {
            unset($this->forms['items']);
        }

        DB::table("shop_brands")
            ->where('id',$this->reply_id)
            ->update($this->forms);

        $this->forms = [];
        $this->editmode = null;
        $this->reply_id = null;

        $this->edit_id = null;
        $this->popupForm = false;
    }

    // 수정메뉴에서, 하위 서브메뉴를 추가 생성모드로 변경
    public function submenu()
    {
        $this->level = $this->forms['level'];
        $this->edit_id = null;

        // 데이터초기화
        $this->forms = [];
        $this->forms['code'] = $this->code;
    }

    public function delete($id=null)
    {
        $this->popupDelete = true;
    }

    public function deleteCancel()
    {
        $this->popupDelete = false;
        $this->popupForm = false;
        $this->setup = false;
    }

    public function deleteConfirm()
    {
        $id = $this->edit_id;

        $this->dbDeleteRow($id);

        $this->popupDelete = false;
        $this->popupForm = false;
        $this->setup = false;

        // 이미지삭제
        //$this->deleteUploadFiles($this->rows[$id]);

    }

    private function dbDeleteRow($id)
    {
        DB::table("shop_brands")
            ->where('id',$id)
            ->delete();
    }
}
