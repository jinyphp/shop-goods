<?php
namespace Jiny\Shop\Goods\Http\Livewire\Category;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\MenuItems;

use Jiny\Table\Http\Livewire\PopupForm;
class AdminCatePopupFrom extends PopupForm
{
    public $cate_id;

    ## 오버라이딩 메소드
    public function create($ref=null)
    {

        // 메뉴코드
        $this->forms['cate_id'] = intval($this->cate_id);

        // 참조값이 있는 경우, 서브트리 생성합니다.
        // 참조값이 없는 경우, 루트 등록을 처리합니다. .
        if($ref) {
            $this->forms['ref'] = intval($ref);  // 정수변환
        } else {
            $this->forms['ref'] = 0; // 루트는 ref값이 0 입니다
        }

        return parent::create();
    }

    ## 오버라이딩 메소드
    public function store()
    {
        // 서브메뉴 트리 입력
        if($this->forms['ref'] !=0) {
            $ref = $this->refRow($this->forms['ref']);
            $this->forms['level'] = $ref->level + 1;
            $this->forms['pos'] = $ref->pos + 1;

            // 삽입, 그위의 모든 row의 pos값을 하나씩 증가
            $this->increasePositionAll(
                $this->forms['pos'],
                ['cate_id'=>$this->cate_id]
            );

        } else
        // 루트등록
        {
            $this->forms['ref'] = 0;
            $this->forms['level'] = 1;
            $this->forms['pos'] = $this->maxPos();
        }
        //dd($this->forms);

        return parent::store();
    }


    private function refRow($ref)
    {
        //참조하는 상위 데이터를 읽어옵니다.
        return DB::table($this->actions['table'])
            ->find($ref);
    }

    private function maxPos()
    {
        // 선택한 메뉴의 최대 아이템값
        $pos = DB::table($this->actions['table'])
        ->where('cate_id',$this->cate_id)
        ->count('pos')+1;

        return $pos;
    }

    private function increasePositionAll($pos, $where=[])
    {
        $db = DB::table($this->actions['table']);

        // 사용자 조건
        foreach($where as $key => $value) {
            $db->where($key,$value);
        }

        // 값증가
        $db->where('pos','>=',$pos)->increment('pos');
    }
}
