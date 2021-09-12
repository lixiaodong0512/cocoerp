<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\JobUser;
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
        //组合一个数据.为了少操作数据库, 就做了一些冗余进来.
        $page = $request->page;
        $limit = $request->limit;
        $offset = ($page-1) * $limit;
        //DB::connection()->enableQueryLog();  // 开启QueryLog
        if(empty($request->title))
            $member = Member::offset($offset)
                ->limit($limit)->get()->toArray();
        else
            $member = Member::where($request->sort, $request->title)->offset($offset)
                ->limit($limit)->get()->toArray();
        $job_ids = array_column($member,'job_id');
        $job_info = JobUser::select('id','name')->wherein('id',$job_ids)->get()->toArray();

        $job_info =  array_column($job_info,NULL,'id');

        foreach ($member as $key => $value)
        {
            $member[$key]['operator'] = $job_info[$value['job_id']]['name'];
            $member[$key]['birthday'] = date('Y-m-d',$value['birthday']);
        }
        $counts  = Member::count();
        $data  = array();
        $data['items'] = $member;
        $data['total'] =$counts;
        echo json_encode(["code" => 20000,'data'=>$data]);
    }

    /**
     * @param Request $request
     * @after  li.xiaodong0512@gmail.com
     * @version 1.0
     */
    public function update(Request $request)
    {
        //因为没有做登录,操作人先暂定超级管理员
        $member = Member::find(1);
        if($member->phone != $request->post('phone')) {
            $member->phone = $request->post('phone');
            DB::beginTransaction();   //做一个事务处理就好了
            try {
                $member->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                throw $e; //将exception继续抛出  生产环境可以修改为报错后的操作
            }
        }

        echo json_encode();

    }

    /**
     * @param Request $request
     * @after  li.xiaodong0512@gmail.com
     * @version 1.0
     */
    public function create(Request $request)
    {
        print_r($request->all());
    }
}
