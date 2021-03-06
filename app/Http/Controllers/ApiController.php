<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use juno_okyo\Chatfuel;
use App\Category;
use App\Product;
use App\Bill;
class ApiController extends Controller
{
    public function index($msg)
    {
        $A = new Chatfuel();
        $A->sendText($msg);
    }

    public function minmax($min, $max)
    {
        $A = new Chatfuel();
        if ($min > $max) {
            $A->sendText('Lỗi : giá trị min phải nhỏ hơn max');
        }

        $A->sendText("Số ngẫu nhiên là : " . rand($min, $max) . " nhé =)) ");
    }

    public function service($msg)
    {
        if ($msg == "category") {
            $data = DB::table('categories')->select(DB::raw('title'))->orderBy('id', 'desc')->get();
            $text = '';
            foreach ($data as $_data) {
                foreach ($_data as $key => $value) {
                    $text .= $value . "\n";
                }
            }
            $A = new Chatfuel;
            $A->sendText($text);
        } elseif ($msg == "product") 
        {

            $data = Product::orderBy('id','desc')->take(10)->get();
            $ars = array();
            $A = new Chatfuel;
            foreach ($data as $_data) {
                $price = "Giá tiền :" . $_data['cost'] . "đ \n";
                $data = Product::with('Color', 'Size', 'product_details')->where('id', $_data['id'])->get()->toArray();
                $text = '';
                foreach ($data as $key) {
                    $array = array();
                    $i = 0;
                    foreach ($key['color'] as $keys) {
                        $array[$i] =  $keys['name'] . "|";
                        $i++;
                    }
                    $i = 0;
                    foreach ($key['size'] as $keys) {
                        $array[$i] .=  $keys['name'] . "|";
                        $i++;
                    }
                    $i = 0;
                    foreach ($key['product_details'] as $keys) {

                        $array[$i] .=   $keys['soluong'] . "|";
                        $i++;
                    }
                    foreach ($array as $ar) {
                        $text .= $ar . "\n";
                    }
                }
                $price .= $text;
                $image = "https://shop-rog.herokuapp.com/images/product/" . $_data['thumbnail'];

                $ars[] = $A->createElement($_data['title'], $image, $price, [
                    $A->createButtonToURL('Mua Ngay', 'https://facebook.com/bossgin.vhb'),
                    $A->createShareButton()
                ]);
            }
           $A->sendGallery($ars);
        } 
        elseif (strpos($msg,"HDSHOPROGTEAM") !== false){
            $id = explode("HDSHOPROGTEAM", $msg);
            $data = Bill::find($id[1]);
            $text = "";
            
            if(!empty($data)){
                $text .= "Hóa đơn : ".$data->id ."\n";
                $text .= "Người mua : ".$data->Users->name."\n";
                $text .= "Đ/C Ship : ".$data->InfoShip->Address ."\n";
                $text .= "Trạng thái : ".getState($data->status) ."\n";
                $text .= "Thanh toán : ".getStatePay($data->statusPay) ."\n";
                $text .= "Tổng tiền :".$data->TotalMoney."\n";
            }else{
                $text .= "Không tồn tại hóa đơn ".$id[1];
            }
            $A = new Chatfuel;
            $A->sendText($text);
        }
        else {
            $A = new Chatfuel;
            $A->sendText("Lệnh không hợp lệ vui lòng gõ category để xem danh mục hoặc product để xem sản phẩm");
        }
    }
}
