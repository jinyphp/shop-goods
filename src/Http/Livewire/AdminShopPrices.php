<?php
namespace Jiny\Shop\Goods\Http\Livewire;

use Illuminate\Support\Facades\DB;

/**
 * 팝업폼 입력시 상품검색을 위하여 컴포넌트 상속
 */
use Jiny\WireTable\Http\Livewire\WireTablePopupForm;
class AdminShopPrices extends WireTablePopupForm
{
    public $popupSearchGoods = false;
    public $searchGoods; // 검색할 상품명
    public $searchGoodRows=[]; // 검색한 상품 목록

    /**
     * 상품명에서 enter 키 입력시 호출
     */
    public function searchGoodsEnter(string $name)
    {
        $this->searchGoods = $name;
        $this->popupSearchGoods = true;

        $rows = DB::table('shop_products')->where('name', 'like', "%".$name."%")->get();
        $this->searchGoodRows = []; //초기화
        foreach($rows as $item) { // obj to array
            $temp = [];
            foreach($item as $key => $value) {
                $temp[$key] = $value;
            }

            $this->searchGoodRows []= $temp;
        }

        //$this->dispatch('adminShopGoodSearch', $name);
    }

    public function popupSearchGoodSelect($i)
    {
        $row = $this->searchGoodRows[$i];

        $selectItem = $row['id'].":".$row['name'];
        $this->forms['goods'] = $selectItem;

        $this->popupSearchGoodsClose();
    }

    public function popupSearchGoodsClose()
    {
        $this->popupSearchGoods = false;
    }

    public function popupSearchGoodsOpen()
    {
        $this->popupSearchGoods = true;
    }


    ## 오버라이딩
    public function popupClose()
    {
        parent::popupClose();
        $this->popupSearchGoodsClose(); // 닫기 기능 추가
    }



}
