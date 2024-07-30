<?php

use Illuminate\Support\Facades\DB;

if(!function_exists("getProductStarInfo")){

    function getProductStarInfo($product_id){

        $StarInfo = [];
        // 각각 상품에 대한 리뷰합계, 평균 별점, 별점 1 ~ 5점 갯수 관리 배열
        $totalReview = 0;
        $starAvg = 0;
        $starCount = array_fill(0, 6, 0);

        // 상품에 대한 리뷰 조회
        $rows = DB::table('reviews')
            ->where('order_item_id', $product_id)
            ->get();

        // row 돌면서 각 변수 세팅
        foreach($rows as $row) {
            $totalReview++;
            $starAvg += $row->rating;
            $starCount[$row->rating]++;
        }

        // review 평점 평균
        $starAvg =  $totalReview == 0 ? 0 : round($starAvg /  $totalReview, 1);

        return ['totalReview'=>$totalReview, 'starAvg'=>$starAvg, 'starCount' => $starCount];
    }

}
