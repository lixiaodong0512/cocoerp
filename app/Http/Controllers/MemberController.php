<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * 存储一个新用户
     *
     * @param  Request  $request
     * @return Response
     */
    public function list(Request $request)
    {
        $res = array();
        $res[0]['author'] = "13800138000";
        $res[0]['comment_disabled']= true;
        $res[0]['content']=  "<p>I am testing data, I am testing data.</p><p><img src=\"https://wpimg.wallstcn.com/4c69009c-0fd4-4153-b112-6cb53d1cf943\"></p>";
        $res[0]['content_short']=  "mock data";
        $res[0]['name']= "赵飞";
        $res[0]['forecast']= 23.54;
        $res[0]['id']= 1;
        $res[0]['image_uri']=  "https://wpimg.wallstcn.com/e4558086-631c-425c-9430-56ffb46e70b3";
        $res[0]['importance']= 2;
        $res[0]['pageviews']= 1126;
        $res[0]['platforms']= ["a-platform"];
        $res[0]['0']= "a-platform";
        $res[0]['reviewer']= "Eric";
        $res[0]['status']= "draft";
        $res[0]['timestamp']= 1553444410495;
        $res[0]['title']= "550.00";
        $res[0]['type']= "JP";
        $data  = array();
        $data['items'] = $res;
        $data['total'] =100;
        echo json_encode(["code" => 20000,'data'=>$data]);
    }
}
