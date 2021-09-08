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
        print_r($request->all());
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
