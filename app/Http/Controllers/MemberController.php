<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

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
        $member = Member::get();
        foreach ($member as $k => $value){
            $res[$k] = $value;
        }

        print_r($res);
        exit;

        $data  = array();
        $data['items'] = $res;
        $data['total'] =100;
        echo json_encode(["code" => 20000,'data'=>$data]);
    }
}
