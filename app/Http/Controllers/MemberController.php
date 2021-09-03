<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

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
        $all_id =  array_column($member,'id');
        $sql = "select uid,balance,max('created_at) form erp_pay_rank where";
        print_r(DB::select('select @@sql_mode'));
        exit;
        $pay_info = DB::table('erp_pay_rank')->select('uid','balance',Db::raw('max(created_at)'))->whereIn('uid',$all_id)->groupBy('uid')->get();
        echo '<pre>';
        print_r($pay_info);
        exit;
        $member[0]['balance'] = $balance['balance'];
        //$job_info = Member::find(1)->jobInfo()->get()->toArray();
        $member[0]['operator'] = "超级管理员";
        $data  = array();
        $data['items'] = $member;
        $data['total'] =100;
        echo json_encode(["code" => 20000,'data'=>$data]);
    }
}
