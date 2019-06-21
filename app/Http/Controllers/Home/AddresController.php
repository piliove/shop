<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Addres;
use DB;
class AddresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addres = DB::table('addres')->get();
        return view('home/addres/index',['addres'=>$addres]);
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
        //接收传值
        $id = $request->input('id');
        dd($id);
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
}
