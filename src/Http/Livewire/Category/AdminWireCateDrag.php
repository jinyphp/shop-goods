<?php
namespace Jiny\Shop\Goods\Http\Livewire\Category;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AdminWireCateDrag extends Component
{
    public $actions = [];
    public $forms=[];
    public $cate_id;
    public $tree;

    public function render()
    {
        ## 메뉴코드 정보를 읽어 옵니다.
        $code = DB::table('categories')->where('id',$this->cate_id)->first();
        if ($code) {

            ## 메뉴데이터를 읽어 옵니다.
            $rows = $this->dbFetch($this->actions);

            ## row 데이터를 계층형으로 tree 구조를 생성합니다.
            $trees = $this->toTree($rows); //전처리
            $this->tree = []; //초기화
            foreach($trees as $tree) {
                // view 전달시, key 이름으로 자동정렬 되기 때문에
                // index로 변환하여 전달함.
                $this->tree []= $tree;
            }

            return view($this->actions['view_list'])
                ->with([
                    'code'=>$code,
                    'tree'=>$this->tree
                ]);
        }

        return <<<'blade'
        <div class="alert alert-danger">
            존재하지 않는 코드 입니다.
        </div>
    blade;
    }

    // 메뉴 데이터 읽기
    private function dbFetch($actions)
    {
        $rows = DB::table($this->actions['table'])
            ->where('cate_id', $this->cate_id)
            ->orderBy('level',"desc")
            ->orderBy('pos',"asc")
            ->get();
        return $rows;
    }

    private function toTree($rows)
    {
        $tree = [];

        // 배열변환
        foreach ($rows as $row) {
            $id = $row->id;
            foreach ($row as $key => $value) {
                $tree[$id][$key] = $value;
            }
        }

        // 계층이동
        foreach($tree as $i => $item) {
            if($item['level'] != 1) {
                $ref = $item['ref'];
                $tree[$ref]['sub'] []= $tree[$i];
                unset($tree[$i]);
            }
        }

        return $tree;
    }

    private function sortByPos($items)
    {
        $tree = [];
        $pos = 1;
        foreach($items as $item) {
            if(isset($item['pos'])) {
                $pos = $item['pos'];
            } else {
                $pos++;
            }

            if(isset($item['sub'])) {
                $item['sub'] = $this->sortByPos($item['sub']);
            }
            $tree[$pos] = $item;
        }
        return $tree;
    }

    protected $listeners = ['refeshTable', 'encodeToJson'];
    public function refeshTable()
    {
        ## 페이지를 재갱신 합니다.
    }


    public function encodeToJson()
    {
        $path = resource_path('category');
        if(!is_dir($path)) {
            mkdir($path,755,true);
        }

        $json = json_encode($this->tree,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($path.DIRECTORY_SEPARATOR.$this->cate_id.".json", $json);
    }



    public $drag = false;
    public function updateTaskOrder($items)
    {
        foreach($items as $item) {
            DB::table($this->actions['table'])
            ->where('id', $item['value'])->update(['pos'=>$item['order']]);
        }
    }

    // 클릭하여 상위로 이동
    public function move_up($id)
    {
        $row = DB::table($this->actions['table'])->find($id);

        $target = DB::table($this->actions['table'])
            ->where('cate_id',$this->cate_id)
            ->where('ref',$row->ref)
            ->where('pos',"<",$row->pos)
            ->orderBy('pos',"desc")->first();

        if($target) {
            DB::table($this->actions['table'])->where('id',$id)->update(['pos'=>$target->pos]);
            DB::table($this->actions['table'])->where('id',$target->id)->update(['pos'=>$row->pos]);
        }
    }

    // 클릭하여 하위로 이동
    public function move_down($id)
    {
        $row = DB::table($this->actions['table'])->find($id);

        $target = DB::table($this->actions['table'])
            ->where('cate_id',$this->cate_id)
            ->where('ref',$row->ref)
            ->where('pos',">",$row->pos)
            ->orderBy('pos',"asc")->first();

        if($target) {
            DB::table($this->actions['table'])->where('id',$id)->update(['pos'=>$target->pos]);
            DB::table($this->actions['table'])->where('id',$target->id)->update(['pos'=>$row->pos]);
        }
    }


}
