<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 使用会员表模型
use App\Models\Member;
// 调用用户表模型
use App\Models\Users;
class MemberController extends Controller
{
    /**
     * 显示会员页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search', null);
        $data = [
        //  ['id', 'like', '%' . $search . '$'],
            ['mname', 'like', '%' . $search . '%'],

        ];
        //查询所有用户数据
        $member = Member::where($data)->orderBy('id')->paginate(3);
        return view('admin.member.index',['member'=>$member,'search'=>$search]);
    }

    /**
     * 添加操作
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->input('id');
        $users = Users::all();
        return view('admin.member.create',['id'=>$id,'users'=>$users]);
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           //接收所有值
        $data = $request->all();

        //判断各项是否为空
        if (!$data['mname'] || !$data['uid']) exit('请确保各项值不为空');
        
        //创建模型写入数据到数据库并判断是否添加成功
        // 实例化momber模型
        $member = new Member;

        // 将数据存入数据库
        $member->mname = $data['mname']; 
        $member->uid = $data['uid'];   
        try {
            // 存入数据库
            $res = $member->save();
            // 判断成功与否
            if ($res) {
                exit('添加成功');
            } else {
                exit('添加失败');
            }
        } catch (\Exception $e) {
            echo '商品名称已存在';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         //接收传值
        $id = $request->input('id');
        //查询id对应用户
        $img = Member::find($id);
        //执行删除操作
        $member = Member::destroy($id);
        if ($member) {
            echo '删除成功';
        } else {
            echo '删除失败';
        }
    }
}
