<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockCardSale extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stc1 = Product::where('pd_group','ผ้าเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','<>','001--0001')
        ->get();
        $stc2 = Product::where('pd_group','ดิสเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->get();
        $stc3 = Product::where('pd_group','ดุมจับสเตอร์')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->get();
        $stc4 = Product::where('pd_group','ดุมหน้าดิส')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->get();
        $stc5 = Product::where('pd_group','ดุมหลังดรัม')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->get();
        $stc6 = Product::where('pd_group','แผงเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->get();
        $stc7 = Product::where('pd_group','ดุมหน้าดรัม')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->get();
        $stc8 = Product::where('pd_group','ดุมหลังดิส')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->get();
        return view('stockcardsale.form-stockcard-sale', compact('stc1','stc2','stc3','stc4','stc5','stc6','stc7','stc8'));
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
        //
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
    public function destroy($id)
    {
        //
    }
}
