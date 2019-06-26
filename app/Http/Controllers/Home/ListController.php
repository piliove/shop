<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取数据
        $countCart = CartController::countCart();
        
        //获取分区数据   
        $cid = $request->input('cid');
        $cates_goods = GetdateController::getCate_list_goods($cid);
        $cates_data = GetdateController::getCate_de($cid);

        //获取分区信息,和商品数量
        $cates = Cates::find($cid);
        $cate_title = $cates->cname;
        $cate_good_count = $cates->goods()->count();

        //获取浏览量最多的三个商品
        $pageview = DB::table('goods')->orderBy('pageview', 'desc')->limit(3)->get();

        return view('home.list.index', ['countCart' => $countCart,
            'cates_goods' => $cates_goods,
            'cid' => $cid,
            'cates_data' => $cates_data,
            'cate_title' => $cate_title,
            'cate_good_count' => $cate_good_count,
            'pageview'=>$pageview,
            'links_data'=>GetdateController::getLink(),
        ]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
