<?php
namespace Jiny\Shop\Goods\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * dragDrop으로 상품을 등록합니다.
 */
class ProductSliderUploadController extends Controller
{
    public function index(Request $requet)
    {
        return "OK";
    }

    public function dropzone(Request $requet)
    {

        $uploaded = [];

        // 업로드 경로 확인하기
        if(isset($_POST['path']) && $_POST['path']) {
            $path = public_path($_POST['path']);
        } else {
            // 경로가 없는 경우, 기본 public/uploads
            $path = public_path("uploads");
        }

        // 날짜 경로를 추가함
        $path .= "/".date("Y/m/d");
        $path = str_replace(["/","\\"],DIRECTORY_SEPARATOR,$path);
        if(!is_dir($path)) {
            mkdir($path, 755, true);
        }

        $uploaded = [
            'path' => $path
        ];

        // 파일 체크 및 업로드
        if (!empty($_FILES['file']['name'][0])) {
            foreach ($_FILES['file']['name'] as $pos => $name) {

                $source = $_FILES['file']['tmp_name'][$pos];

                // 디렉터리 정리
                $filename = $path.DIRECTORY_SEPARATOR.$name;
                $filename = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR,
                    DIRECTORY_SEPARATOR, $filename);

                //$uploaded['source'] = $source;
                //$uploaded []= $filename;

                if( move_uploaded_file($source, $filename) ){
                    $created_at = date("Y-m-d H:i:s");

                    // 이미지 url 정리
                    $image = str_replace(public_path(),"",$filename);
                    $image = trim($image, DIRECTORY_SEPARATOR);
                    $image = str_replace(DIRECTORY_SEPARATOR, "/", $image);

                    $uploaded['image'] = $image;

                    // 상품이미지 슬라이더에 추가
                    $id = DB::table('shop_goods_images')->insertGetId([
                        'goods'=> $_POST['slug'], //slug추가해서 조회
                        'image'=>"/".$image,
                        'created_at' => $created_at,
                        'updated_at' => $created_at
                    ]);

                    /*
                    // 카테고리 관계
                    DB::table('shop_product_categories')->updateOrInsert([
                        'product_id'=>$id,
                        'category_id'=>$_POST['category'],
                        'created_at' => $created_at,
                        'updated_at' => $created_at
                    ]);

                    // 파일 업로드 성공, 결과 상태값 반환
                    $uploaded []= [
                        'status' => 200,
                        'name' => $name,
                        'file' => $filename,
                        'category' => $_POST['category']
                    ];
                    */



                }

            }
        }

        return response()->json($uploaded);

    }




    public function images(Request $requet)
    {
        $uploaded = [];
        $uploaded['status'] = 201;

        // 업로드 경로 확인하기
        if(isset($_POST['path']) && $_POST['path']) {
            $path = base_path($_POST['path']);
        } else {
            // 경로가 없는 경우, 기본 public/uploads
            $path = public_path("uploads");
        }

        // 날짜 기반의 경로패스 변경
        $path = str_replace("/",DIRECTORY_SEPARATOR,$path);
        $datePath = date("Y/m/d");
        $path .= '/'.$datePath; // 날자 디렉터리 파싱
        if (!is_dir($path)) mkdir($path, 755, true);

        // 파일 체크 및 업로드
        if (!empty($_FILES['file']['name'][0])) {
            foreach ($_FILES['file']['name'] as $pos => $name) {

                $source = $_FILES['file']['tmp_name'][$pos];
                $filename = $path.DIRECTORY_SEPARATOR.$name;
                $filename = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $filename);

                if( move_uploaded_file($source, $filename) ){
                    $created_at = date("Y-m-d H:i:s");

                    // 상품목록 추가

                    $imagePath = str_replace('/public','',config('shop.path.products.images')).'/'.$datePath.'/'.$name;
                    $id = DB::table('shop_product_images')->insertGetId([
                        'product_id' => $_POST['product_id'],
                        'image'=>$imagePath,
                        'created_at' => $created_at,
                        'updated_at' => $created_at
                    ]);

                    /*

                    // 카테고리 관계
                    DB::table('shop_product_categories')->updateOrInsert([
                        'product_id'=>$id,
                        'category_id'=>$_POST['category'],
                        'created_at' => $created_at,
                        'updated_at' => $created_at
                    ]);
                    */

                    // 파일 업로드 성공, 결과 상태값 반환
                    $uploaded []= [
                        'status' => 200,
                        'name' => $name,
                        'file' => $filename,
                        'category' => $_POST['product_id']
                    ];
                }
            }
        }

        return response()->json($uploaded);
    }




    //
}
