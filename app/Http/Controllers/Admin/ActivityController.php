<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入文件储存控制
use Illuminate\Support\Facades\Storage;
//引用正则
use App\Http\Requests\CheckActivity;
//引入模型对象
use App\Models\Activity;
use App\Models\Goods;
//引入数据库语句
use DB;

class ActivityController extends Controller
{
    /**
     * 显示 主页面
     *
     * @param search_key(搜索关键词)
     * @return 23行
     * @return_param $activities_data(数据库所有数据) $search_key(搜索关键字)
     */
    public function index(Request $request)
    {
        //获得关键词
        $search_key = $request->input('atitle','');
        //实例化模型,去除所有数据
        $activities_data = Activity::where('activity_title','like','%'.$search_key.'%')->orderBy('id','asc')->paginate(5);

        return view('admin.activity.index',['activities_data'=>$activities_data, 'search_key'=>$search_key]);
    }

    /**
     * 显示 添加 页面
     *
     * @return 33行
     */
    public function create()
    {
        return view('admin.activity.create');
    }
    

    /**
     * 执行 添加 操作
     *
     * @param  Request(atitle(标题), desc(描述), tag(标签), profile(图片), stime_time(开始时间), 
     *         stime_date(开始日期), etime_date(结束日期), etime_time(结束时间), status(开启状态))
     * @return 78行
     * @return_param session('msg')(提示数据)
     */
    public function store(CheckActivity $request)
    {
        
        //通过验证后,开始实例化对象
        $activity = new Activity();

        //判断是否传入图片,如果传入,则存入数据库
        if ($request->hasFile('profile')) {
            //开始压入图片路径
            $activity->activity_path = $request->file('profile')->store(date('Ymd')); 
            //删除缓存文件夹的图片
            Storage::deleteDirectory('temp');
        }

        //开始拼合开始时间
        $start_time_date = $request->input('stime_date');
        $start_time_time = $request->input('stime_time');
        $start_time = $start_time_date.' '.$start_time_time.':00';
        
        //开始拼合结束时间
        $end_time_date = $request->input('etime_date');
        $end_time_time = $request->input('etime_time');
        $end_time = $end_time_date.' '.$end_time_time.':00';
        
        //压入标题,描述,标签名,开始时间,结束时间
        $activity->activity_title = $request->input('atitle');
        $activity->activity_desc = $request->input('desc');
        $activity->activity_tag = $request->input('tag');
        $activity->activity_status = $request->input('status'); 
        $activity->start_time = $start_time;
        $activity->end_time = $end_time;
        
        //压入数据库
        $res = $activity->save();

        //判断情况
        if ( $res ) {
            //装填session
            session(['activity_msg'=>'添加成功']);
            return redirect('/admin/activity');
        } else {
            session(['activity_msg'=>'添加失败']);
            return back();
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
     * 显示 修改 页面
     *
     * @param  id(被修改的记录id)
     * @return_param activity_data(原数据)
     */
    public function edit($id)
    {
        //找到该记录的数据
        $activity_data = Activity::find($id);
        
        //开始传输回去
        return view('admin.activity.edit',['activity_data'=>$activity_data]);
    }

    /**
     * 执行 修改 操作
     *
     * @param  Request(atitle(修改标题), desc(修改描述), tag(修改标签), profile(图片),status(修改开启状态), start_time(开始时间),end_time(关闭时间))
     *  
     *         
     * @param  int  $id(修改的id)
     * @return 165行
     * @return_param session('activity_msg');
     */
    public function update(Request $request, $id)
    {   
        
        //通过验证后,开始实例化模型
        $this->validate($request, [
            'start_time'=>'regex:/^[0-9]{4}-[0-3]{1}[0-9]{1}-[0-9]{2} [0-2]{1}[0-9]:[0-6]{1}[0-9]{1}:[0-6]{1}[0-9]{1}$/',
            'end_time'=>'regex:/^[0-9]{4}-[0-3]{1}[0-9]{1}-[0-9]{2} [0-2]{1}[0-9]:[0-6]{1}[0-9]{1}:[0-6]{1}[0-9]{1}$/',
            
        ],[
            'start_time.regex'=>'没有按照格式化模式写入',
            'end_time.regex'=>'没有按照格式化模式写入'
        ]);
        $activity = Activity::find($id);
           
        //判断有无头像传入
        if ($request->hasFile('profile')) {
            //开始压入图片路径
            $activity->activity_path = $request->file('profile')->store(date('Ymd')); 
            //删除缓存文件夹的图片
            Storage::deleteDirectory('temp');
        }
        //开始修改数据
        $activity->activity_title = $request->input('atitle');
        $activity->activity_desc = $request->input('desc');
        $activity->activity_tag = $request->input('tag');
        $activity->activity_status = $request->input('status'); 
        $activity->start_time = $request->input('start_time');
        $activity->end_time = $request->input('end_time');

        $res = $activity->save();

        //判断结果
        if ($res) {
            session(['activity_msg'=>'修改成功']);
            return redirect('/admin/activity');
        } else {
            session(['activity_msg'=>'修改失败']);
            return back();
        }
        


        
    }

    /**
     * 执行 删除 操作
     *
     * @param  int  $id
     * @return json(msg)
     */
    public function destroy($id)
    {   
        $activity = Activity::find($id);
        $path = $activity->activity_path;

        //检查是否有图片
        $exists = Storage::disk('local')->exists($path);

        //若有图片,则直接删除
        if ($exists) {
            Storage::delete($path);
        }


        //开始实例化模型
        $res = Activity::destroy($id);

        if ($res) {
            return json_encode(['info'=>'删除成功']);
        } else {
            return json_encode(['info'=>'删除失败']);
        }
    }

    /**
     * 异步 得到图片
     *
     * @param  Request(profile(缓存图片))
     * @return_param json_encode(['path', 'info']);
     */
    public function getProfile(Request $request)
    {
        //判断图片是否上传
        if ($request->hasFile('profile')) {
            $profile_path = $request->file('profile')->store('temp');
            echo json_encode(['path'=>$profile_path,'info'=>'上传成功']);
        } else {
            echo json_encode(['info'=>'图片未上传','path'=>'']);
        }

        

    }

    /**
     * 异步 改变消息
     *
     * @param  
     * 
     */
    public function change(Request $request)
    {
        if ($request->input('msg')) {
            session(['activity_msg'=>null]);
        }
    }

     /**
     * 显示活动商品详情 页面
     *
     * @param  Request(id(活动id), search_key(搜索关键字))
     * @return 258行
     * @return_param act_goods_data 活动商品数据 serch_key 关键字数据
     */
     public function actGoods(Request $request)
     {
         //搜索关键字
         $search_key = $request->input('search_key','');
         //取的活动id
         $id = $request->input('id');
         //实例化模型
         $activity = Activity::find($id);
         //根据id取的一对多关系的活动商品
         $act_goods_data = $activity->goods()->paginate(5);
         return view('admin.activity.actinfo',['act_goods_data'=>$act_goods_data, 'search_key'=>$search_key, 'aid'=>$id]);
     }

     /**
     * 取消活动商品资格
     *
     * @param  Request(id(商品id))
     * @return 276行
     */
     public function delActGoods(Request $request)
     {
         //取的要修改的活动商品id
         $id = $request->input('id');

         //修改活动id
         $res = DB::table('goods')->where('id',$id)->update(['activity_id'=>0]);

         if($res){
             echo '修改成功';
         } else {
             echo '修改失败';
         }

     }

     /**
     * 添加活动商品资格
     *
     * @param  Request(id(活动id))
     * @return 
     */
     public function createActGoods(Request $request)
     {
         
         //搜索关键字
         $search_key = $request->input('search_key','');
         $aid = $request->input('aid');
         //添加所有的商品
         $goods_data = Goods::where('gname','like','%'.$search_key.'%')->where('activity_id',0)->paginate(5);

         return view('admin.activity.createActGoods',['goods_data'=>$goods_data, 'search_key'=>$search_key, 'aid'=>$aid]); 
     }

     public static $temp = array();

     public function addActGoods(Request $request)
     {
         //接收数据
       $id = $request->input('id');
       $add = $request->input('add');
       $aid = $request->input('aid');
       
       if($add == "1"){
           DB::table('goods')->where('id',$id)->update(['activity_id'=>$aid]);
          
       } else {
           DB::table('goods')->where('id',$id)->update(['activity_id'=>0]);
       }
     

     }
}
