<?php

namespace App\Http\Controllers\Wei;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;


class WeiController extends Controller
{
    //
    public function valid(){
        echo $_GET['echostr'];
    }
    public function wxEvent(){
        $content=file_get_contents("php://input");
        $time=date("Y-m-d H:i:s");
        $str=$time . $content ."\n";
        file_put_contents("logs/wx_event.log",$str,FILE_APPEND);
        echo 'SUCCESS';
        // $data = simplexml_load_string($content);
        // var_dump($data);
    }
    //获取token值
    public function toke(){
            $key="token";
            $token=Redis::get($key);
            if($token){
                echo "有缓存";
            }else{
                echo "没有缓存";
                $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WX_APPID').'&secret='.env('WX_APPSECRET').'';
                $response=file_get_contents($url);
                //echo $response;
                $arr=json_decode($response,true);
                //var_dump($arr);
                Redis::set($key,$arr['access_token']);
                 Redis::expire($key,3600);
                 //echo $token;
                 $token=$arr['access_token'];
            }
           return $token;
    }
}
