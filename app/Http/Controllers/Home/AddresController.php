<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Addres;
use DB;
// 使用Cart控制器的方法
use App\Http\Controllers\Home\CartController;

class AddresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();

        $addres = DB::table('addres')->get();

        // 渲染 地址管理页面
        return view('home/addres/index',['addres'=>$addres,'countCart'=>$countCart]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // 验证数据
        $this->validate($request, [
            'name' => 'required|max:10',
            'aname' => 'required|max:20',
            'dname' => 'required|max:50',
            'aphone' => 'required|max:20',
        ],[
            'name.required'=>'收货人必填',
            'name.regex'=>'收货人格式错误',
            'aname.required'=>'地址必填',
            'aname.regex'=>'地址格式错误',
            'dname.required'=>'详细地址必填',
            'dname.email'=>'详细地址错误',
            'aphone.required'=>'手机号必填',
            'aphone.regex'=>'手机号格式不正确',
        ]);
        
        $data = $request->all();
        // 接收数据
        $addres = new Addres;
        $addres->name = $data['name'];
        
        $addres->dname = $data['dname'];
        $addres->aphone = $data['aphone'];

        $aname = $data['aname'];
        $comma_separated = implode(" ", $aname);
        
        $addres->aname=$comma_separated;

        $res = $addres->save();
        if($res){
            DB::commit();
            return redirect('home/addres')->with('success','添加成功');
        }else{
            DB::rollBack();
            return back()->with('error','添加失败');
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
         // 获取商品管理指定数据信息
        $addres = Addres::find($id);

        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();

        // 渲染 添加管理页面
        return view('home.addres.edit',['addres'=>$addres,'countCart'=>$countCart]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //接收修改表单所有值
        $data = $request->all();
        // dd($request->all);exit;
        $addres = Addres::find($data['id']);
        //判断token是否一致
        if ($addres->_token !== $data['token']) exit('验证失败');

        //判断各项是否为空
        if (!$data['name'] || !$data['aname'] || !$data['dname'] || !$data['aphone']) exit('请确保各项值不为空');
        // 接收数
        $addres->name = $data['name'];
        $addres->dname = $data['dname'];
        $addres->aphone = $data['aphone'];
        $aname = $data['aname'];
        $comma_separated = implode(" ", $aname);
        
        $addres->aname=$comma_separated;
        $path = $addres->save();
        if ($path) {
            exit('修改成功');
        } else {
            exit('修改失败');
        }

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
        $img = Addres::find($id);
        //执行删除操作
        $addres = Addres::destroy($id);
        if ($addres) {
            echo '删除成功';
        } else {
            echo '删除失败';
        }
    }
    public function changeStatus(Request $request)
    {
       //接收修改表单所有值
        $data = $request->all();
        // dd($request->all);exit;
        $addres = Addres::find($data['id']);
    
        // 接收数
        $addres->status = $data['status'];
        $path = $addres->save();
        if($path){
            return back()->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
}
