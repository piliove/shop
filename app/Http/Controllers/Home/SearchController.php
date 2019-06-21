<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use DB;

class SearchController extends Controller
{
    // 初始化
    public function __construct()
    {
        // 引入类文件
        require './pscws4/pscws4.class.php';

        // 实例化
        @$this->cws = new \PSCWS4;
        //设置字符集
        $this->cws->set_charset('utf8');
        //设置词典
        $this->cws->set_dict('pscws4/etc/dict.utf8.xdb');
        //设置utf8规则
        $this->cws->set_rule('pscws4/etc/rules.utf8.ini');
        //忽略标点符号
        $this->cws->set_ignore(true);
    }

    public function dataWord()
    {
        // 获取goods商品表的数据
        $data = DB::table('goods')->select('gtitle','id')->get();

        // 遍历
        foreach($data as $k => $v){
            $arr = $this->word($v->gtitle);
            foreach($arr as $kk => $vv){
                DB::table('goods_word')->insert(['gid'=>$v->id,'word'=>$vv]);
            }
        }
    }

    // 显示搜索列表首页
    public function index(Request $request)
    {
        $this->dataWord();
        // $str = '万达会带172913来伏%安法德哈卡都好看哇';
        // $this->word($str);

        // 获取前台首页提交的搜索结果
        $search = $request->input('search','');

        // 获取数据库中的所有商品数据
        // $goods = Goods::where('gtitle','like','%'.$search.'%')->paginate(5);

        /* 利用中文分词获取查询结果 开始*/
        if (!empty($search)) {
            $gid = DB::table('view_goods_word')->select('gid')->where('word',$search)->get();
        
            $gids = [];
            foreach($gid as $k => $v){
                $gids[] = $v->gid;
            }
    
            $data = DB::table('goods')->whereIn('id',$gids)->get();
        } else {
            $data = DB::table('goods')->get();
        }
        /*利用中文分词获取查询结果 结束*/

        // 渲染 搜索列表页面
        return view('home.search.index',['search'=>$search,'data'=>$data]);
    }

    public function word($text)
    {
        // 将$text以空格切割成数组的形式
        $arr = explode(' ',$text);
        // 正则表达式 匹配字符
        $preg = '/[\w\+\%\.\(\)]+/';

        $string = '';
        foreach($arr as $k => $v){
            // $string .= $v;
            // if(!preg_match($preg,$v)){
            //     $string .= $v;
            // }

            // 替换
            $string .= preg_replace($preg,'',$v);
        }

        //传递字符串
        $this->cws->send_text($string);
        //获取权重最高的前十个词
        // $res = $cws->get_tops(10);// top 顶部
        //获取所有的结果
        $res = $this->cws->get_result();

        $list = [];
        foreach($res as $key => $value){
            $list[] = $value['word'];
        }
        return $list;
    }

    // 释放变量
    public function __destruct()
    {
        //关闭
        $this->cws->close();
    }

}
