<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReportSaleOrder extends Controller
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
        //
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
    public function ReportBacklogList(Request $request)
    {
        if(Auth::user()->id == 1 || Auth::user()->id == 10 || Auth::user()->id == 11){
            $hd = DB::table('vw_saleorder_backlog')
            ->get();
            $sum = DB::table('vw_saleorder_backlog')
            ->sum('NETAMOUNT');
        }
        else {
            $hd = DB::table('vw_saleorder_backlog')
            ->where('SALECODE',Auth::user()->username)
            ->get();
            $sum = DB::table('vw_saleorder_backlog')
            ->where('SALECODE',Auth::user()->username)
            ->sum('NETAMOUNT');
        }
        return view('reportsale.form-report-salebcaklog', compact('hd','sum'));
    }
    public function ReportSendProductList(Request $request)
    {
        if(Auth::user()->id == 1 || Auth::user()->id == 10 || Auth::user()->id == 11){
            $hd = DB::table('vw_saleorder_tras')
            ->get();
        }
        else {
            $hd = DB::table('vw_saleorder_tras')
            ->where('salecode',Auth::user()->username)
            ->get();
        }
        return view('reportsale.form-report-sendproduct', compact('hd'));
    }
    public function ReportBillOrderList(Request $request)
    {
        if(Auth::user()->id == 1 || Auth::user()->id == 10 || Auth::user()->id == 11){
            $hd = DB::table('vw_saleorder_bill')
            ->get();
        }
        else {
            $hd = DB::table('vw_saleorder_bill')
            ->where('salecode',Auth::user()->username)
            ->get();
        }
        return view('reportsale.form-report-billorder', compact('hd'));
    }
    public function ReportGroupLowList(Request $request)
    {
        if(Auth::user()->id == 1 || Auth::user()->id == 10 || Auth::user()->id == 11){
            $hd = DB::table('api_productgrouplow')
            ->get();
        }
        else {
            $hd = DB::table('api_productgrouplow')
            ->where('salecode',Auth::user()->username)
            ->get();
        }
        return view('reportsale.form-report-grouplow', compact('hd'));
    }
    public function ReportSaleOrderList(Request $request)
    {
        if(Auth::user()->id == 1 || Auth::user()->id == 10 || Auth::user()->id == 11){
            $hd1 = DB::table('vw_saleorderproductgroup_all')
            ->get();
            $hd2 = DB::table('vw_saleorderprovince_all')
            ->get();
            $hd3 = DB::table('vw_saleorderall_all')
            ->get();
            $hd4 = DB::table('vw_saleordercustomer_all')
            ->get();
        }
        else {
            $hd1 = DB::table('vw_saleorderproductgroup_sale')
            ->where('salecode',Auth::user()->username)
            ->get();
            $hd2 = DB::table('vw_saleorderprovince_sale')
            ->where('salecode',Auth::user()->username)
            ->get();
            $hd3 = DB::table('vw_saleorderall_sale')
            ->where('salecode',Auth::user()->username)
            ->get();
            $hd4 = DB::table('vw_saleordercustomer_sale')
            ->where('salecode',Auth::user()->username)
            ->get();
        }
        return view('reportsale.form-report-saleorder', compact('hd1','hd2','hd3','hd4'));
    }
    public function ReportSaleOrderMonthList(Request $request)
    {
        if(Auth::user()->id == 1 || Auth::user()->id == 10 || Auth::user()->id == 11){
            $hd1 = DB::table('vw_saleorderproductgroup_allmonth')
            ->get();
            $hd2 = DB::table('vw_saleorderprovince_all')
            ->get();
            $hd3 = DB::table('vw_saleorderall_allmonth')
            ->get();
            $hd4 = DB::table('vw_saleordercustomer_allmonth')
            ->get();
        }
        else {
            $hd1 = DB::table('vw_saleorderproductgroup_salemonth')
            ->where('salecode',Auth::user()->username)
            ->get();
            $hd2 = DB::table('vw_saleorderprovince_sale')
            ->where('salecode',Auth::user()->username)
            ->get();
            $hd3 = DB::table('vw_saleorderall_salemonth')
            ->where('salecode',Auth::user()->username)
            ->get();
            $hd4 = DB::table('vw_saleordercustomer_salemonth')
            ->where('salecode',Auth::user()->username)
            ->get();
        }
        return view('reportsale.form-report-saleordermonth', compact('hd1','hd2','hd3','hd4'));
    }
}
