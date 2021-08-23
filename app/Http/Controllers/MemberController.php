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
        $member = Member::get()->toArray();

        $data  = array();
        $data['items'] = $member;
        $data['total'] =100;
        echo json_encode(["code" => 20000,'data'=>$data]);
    }
}
