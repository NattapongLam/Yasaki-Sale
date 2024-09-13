<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RequestOrderSale extends Controller
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
        if(Auth::user()->id == 1 || Auth::user()->id == 10 || Auth::user()->id == 11){
            $hd = DB::table('requestorder_hd')
            ->leftjoin('requestorder_status','requestorder_hd.requestorder_status_id','=','requestorder_status.requestorder_status_id')
            ->leftjoin('sale_employee','requestorder_hd.requestorder_hd_sale','=','sale_employee.sa_code')
            ->where('requestorder_hd.requestorder_status_id','<>',2)
            ->get();
        }
        else {
            $hd = DB::table('requestorder_hd')
            ->leftjoin('requestorder_status','requestorder_hd.requestorder_status_id','=','requestorder_status.requestorder_status_id')
            ->leftjoin('sale_employee','requestorder_hd.requestorder_hd_sale','=','sale_employee.sa_code')
            ->where('requestorder_hd_sale',Auth::user()->username)
            ->where('requestorder_hd.requestorder_status_id','<>',2)
            ->get();
        }
         return view('requestordersale.form-open-requestorder', compact('hd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->id == 1 || Auth::user()->id == 10 || Auth::user()->id == 11){
            $cust = Customer::leftjoin('vw_requestorder_pricetotal','customers.customer_code','=','vw_requestorder_pricetotal.arcode')
            ->get();
            $sale = DB::table('sale_employee')->get();
        }
        else {
            $cust = Customer::leftjoin('vw_requestorder_pricetotal','customers.customer_code','=','vw_requestorder_pricetotal.arcode')
            ->where('customers.sale_code',Auth::user()->username)->get();
            $sale = DB::table('sale_employee')
            ->where('sa_code',Auth::user()->username)
            ->get();
        }
        $stc1 = Product::where('pd_group','ผ้าเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_name','not like','%**%')
        ->where('pd_code','<>','001--0001')
        ->where('pd_name','like','%VIP%')
        ->where('pd_code','not like','001-B%')
        ->where('pd_code','not like','001-KC%')
        ->where('pd_code','not like','001-MKT%')
        ->where('pd_code','not like','001-S%')
        ->get();
        $stc1_1 = Product::where('pd_group','ผ้าเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_name','not like','%**%')
        ->where('pd_code','<>','001--0001')
        ->where('pd_name','like','%Super%')
        ->where('pd_code','not like','001-A%')
        ->where('pd_code','not like','001-KC%')
        ->get();
        $stc1_2 = Product::where('pd_group','ผ้าเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','<>','001--0001')
        ->where('pd_name','not like','%**%')
        ->where('pd_name','like','%Premium%')
        ->where('pd_code','not like','001-A%')
        ->where('pd_code','not like','001-MKT%')
        ->get();
        $stc2 = Product::where('pd_group','ดิสเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_name','like','%ฟ้า%')
        ->where('pd_code','not like','002-A%')
        ->where('pd_code','not like','002-S%')
        ->where('pd_code','not like','002-กต%')
        ->where('pd_name','not like','%ยังไม่ได้ผลิต%')
        ->get();
        $stc2_1 = Product::where('pd_group','ดิสเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_name','like','%ทอง%')
        ->where('pd_code','not like','002-A%')
        ->get();
        $stc2_2 = Product::where('pd_group','ดิสเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_name','like','%REVOTEQ%')
        ->where('pd_code','not like','002-A%')
        ->where('pd_name','not like','%ยังไม่ได้ผลิต%')
        ->get();
        $stc3 = Product::where('pd_group','ดุมจับสเตอร์')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','007-HP%')
        ->where('pd_code','not like','007-RU%')
        ->where('pd_code','not like','007-S%')
        ->get();
        $stc4 = Product::where('pd_group','ดุมหน้าดิส')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','008-HP%')
        ->where('pd_code','not like','008-M%')
        ->where('pd_code','not like','009-M%')
        ->where('pd_code','not like','015-%')
        ->get();
        $stc5 = Product::where('pd_group','ดุมหลังดรัม')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','009-HP%')
        ->where('pd_code','not like','009-LZ%')
        ->where('pd_code','not like','009-NB%')
        ->where('pd_code','not like','009-RU%')
        ->where('pd_code','not like','009-S%')
        ->where('pd_code','not like','009-VN%')
        ->get();
        $stc6 = Product::where('pd_group','แผงเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','007-%')
        ->get();
        $stc7 = Product::where('pd_group','ดุมหน้าดรัม')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','014-HP%')
        ->where('pd_code','not like','014-RU%')
        ->where('pd_code','not like','014-S%')
        ->where('pd_code','not like','014-VN%')
        ->get();
        $stc8 = Product::where('pd_group','ดุมหลังดิส')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','015-M%')
        ->where('pd_code','not like','008-%')
        ->where('pd_code','not like','009-%')
        ->get();
        $docs_last = DB::table('requestorder_hd')
            ->where('requestorder_hd_docuno', 'like', '%' . date('ym') . '%')
            ->orderBy('requestorder_hd_id', 'desc')->first();
        if ($docs_last) {
            $docs = 'PR' . date('ym')  . str_pad($docs_last->requestorder_hd_number + 1, 4, '0', STR_PAD_LEFT);
            $docs_number = $docs_last->requestorder_hd_number + 1;
        } else {
            $docs = 'PR' . date('ym')  . str_pad(1, 4, '0', STR_PAD_LEFT);
            $docs_number = 1;
        }
        return view('requestordersale.form-create-requestorder', compact('stc1','stc2','stc3','stc4','stc5','stc6','stc7','stc8','cust','sale','docs','docs_number','stc1_1','stc1_2','stc2_1','stc2_2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $docs_last = DB::table('requestorder_hd')
            ->where('requestorder_hd_docuno', 'like', '%' . date('ym') . '%')
            ->orderBy('requestorder_hd_id', 'desc')->first();
        if ($docs_last) {
            $docs = 'PR' . date('ym')  . str_pad($docs_last->requestorder_hd_number + 1, 4, '0', STR_PAD_LEFT);
            $docs_number = $docs_last->requestorder_hd_number + 1;
        } else {
            $docs = 'PR' . date('ym')  . str_pad(1, 4, '0', STR_PAD_LEFT);
            $docs_number = 1;
        }
        $request->validate([
            'requestorder_hd_sale' => 'required',
            'pd_id' => 'required',
            'pd_code' => 'required',
        ]);
        $cust = Customer::where('customer_code',$request->customer_code)->first();
        $hd = [
            'requestorder_hd_date' => $request->requestorder_hd_date,
            'requestorder_hd_docuno' => $docs,
            'requestorder_hd_number' => $docs_number,
            'customer_code' => $cust->customer_code,
            'customer_name' => $cust->customer_name,
            'requestorder_hd_duedate' => $request->requestorder_hd_duedate,
            'requestorder_hd_reamrk' => $request->requestorder_hd_reamrk,
            'requestorder_status_id' => 1,
            'requestorder_hd_sale' => $request->requestorder_hd_sale,
            'create_at' => Carbon::now(),
            'person_at' => Auth::user()->username
        ];
        try {
            $inhd = DB::table('requestorder_hd')->insert($hd);
            $idhd = DB::table('requestorder_hd')->where('requestorder_hd_docuno', $docs)->first();
            DB::beginTransaction();
            foreach($request->pd_code as $key => $val){
                $pd = Product::where('pd_code',$val)->first();
                $dt = DB::table('requestorder_dt')->insert([
                    'requestorder_hd_id' => $idhd->requestorder_hd_id,
                    'pd_code' => $pd->pd_code,
                    'pd_name' => $pd->pd_name,
                    'pd_unit' => $pd->pd_unit,
                    'pd_group' => $pd->pd_group,
                    'pd_stc' => $pd->pd_stc,
                    'pd_price' => $pd->pd_price,
                    'requestorder_dt_qty' => $request->pd_qty[$key],
                    'requestorder_dt_flag' => true,
                    'create_at' => Carbon::now(),
                    'person_at' => Auth::user()->username,
                    'requestorder_dt_listno' => $key+1
                ]);
            }
            DB::commit();
            return redirect()->route('requestorder.index')->with('success', 'บันทึกเรียบร้อย');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('requestorder.index')->with('error', 'บันทึกไม่สำเร็จ');
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
        $hd = DB::table('requestorder_hd')
        ->leftjoin('sale_employee','requestorder_hd.requestorder_hd_sale','=','sale_employee.sa_code')
        ->where('requestorder_hd.requestorder_hd_id',$id)
        ->first();
        $dt = DB::table('requestorder_dt')
        ->where('requestorder_hd_id',$id)
        ->where('requestorder_dt_flag',true)
        ->get();
        return view('requestordersale.form-view-requestorder', compact('hd','dt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stc1 = Product::where('pd_group','ผ้าเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_name','not like','%**%')
        ->where('pd_code','<>','001--0001')
        ->where('pd_name','like','%VIP%')
        ->where('pd_code','not like','001-B%')
        ->where('pd_code','not like','001-KC%')
        ->where('pd_code','not like','001-MKT%')
        ->where('pd_code','not like','001-S%')
        ->get();
        $stc1_1 = Product::where('pd_group','ผ้าเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_name','not like','%**%')
        ->where('pd_code','<>','001--0001')
        ->where('pd_name','like','%Super%')
        ->where('pd_code','not like','001-A%')
        ->where('pd_code','not like','001-KC%')
        ->get();
        $stc1_2 = Product::where('pd_group','ผ้าเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','<>','001--0001')
        ->where('pd_name','not like','%**%')
        ->where('pd_name','like','%Premium%')
        ->where('pd_code','not like','001-A%')
        ->where('pd_code','not like','001-MKT%')
        ->get();
        $stc2 = Product::where('pd_group','ดิสเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_name','like','%ฟ้า%')
        ->where('pd_code','not like','002-A%')
        ->where('pd_code','not like','002-S%')
        ->where('pd_code','not like','002-กต%')
        ->where('pd_name','not like','%ยังไม่ได้ผลิต%')
        ->get();
        $stc2_1 = Product::where('pd_group','ดิสเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_name','like','%ทอง%')
        ->where('pd_code','not like','002-A%')
        ->get();
        $stc2_2 = Product::where('pd_group','ดิสเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_name','like','%REVOTEQ%')
        ->where('pd_code','not like','002-A%')
        ->where('pd_name','not like','%ยังไม่ได้ผลิต%')
        ->get();
        $stc3 = Product::where('pd_group','ดุมจับสเตอร์')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','007-HP%')
        ->where('pd_code','not like','007-RU%')
        ->where('pd_code','not like','007-S%')
        ->get();
        $stc4 = Product::where('pd_group','ดุมหน้าดิส')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','008-HP%')
        ->where('pd_code','not like','008-M%')
        ->where('pd_code','not like','009-M%')
        ->where('pd_code','not like','015-%')
        ->get();
        $stc5 = Product::where('pd_group','ดุมหลังดรัม')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','009-HP%')
        ->where('pd_code','not like','009-LZ%')
        ->where('pd_code','not like','009-NB%')
        ->where('pd_code','not like','009-RU%')
        ->where('pd_code','not like','009-S%')
        ->where('pd_code','not like','009-VN%')
        ->get();
        $stc6 = Product::where('pd_group','แผงเบรค')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','007-%')
        ->get();
        $stc7 = Product::where('pd_group','ดุมหน้าดรัม')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','014-HP%')
        ->where('pd_code','not like','014-RU%')
        ->where('pd_code','not like','014-S%')
        ->where('pd_code','not like','014-VN%')
        ->get();
        $stc8 = Product::where('pd_group','ดุมหลังดิส')
        ->where('pd_flag',true)
        ->where('pd_name','not like','%***%')
        ->where('pd_code','not like','015-M%')
        ->where('pd_code','not like','008-%')
        ->where('pd_code','not like','009-%')
        ->get();
        $hd = DB::table('requestorder_hd')
        ->leftjoin('sale_employee','requestorder_hd.requestorder_hd_sale','=','sale_employee.sa_code')
        ->leftjoin('vw_requestorder_pricetotal','requestorder_hd.customer_code','=','vw_requestorder_pricetotal.arcode')
        ->where('requestorder_hd.requestorder_hd_id',$id)
        ->first();
        $dt = DB::table('requestorder_dt')
        ->where('requestorder_hd_id',$id)
        ->where('requestorder_dt_flag',true)
        ->get();
        $product = DB::table('api_saleorder_backlog')
        ->where('ARCODE', $hd->customer_code)
        ->selectRaw("ITEMCODE")
        ->selectRaw("ITEMNAME")
        ->selectRaw("SUM(REMAINQTY) as REMAINQTY")
        ->groupBy('ITEMCODE','ITEMNAME')
        ->get();
        $bill =DB::table('vw_billorder_pricetotal')
        ->where('arcode',$hd->customer_code)
        ->first();
        return view('requestordersale.form-edit-requestorder', compact('stc1','stc2','stc3','stc4','stc5','stc6','stc7','stc8','hd','dt','stc1_1','stc1_2','stc2_1','stc2_2','product','bill'));
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
        try {
            DB::beginTransaction();
            $hd = DB::table('requestorder_hd')
            ->where('requestorder_hd_id',$id)
            ->update([
                'requestorder_hd_reamrk' => $request->requestorder_hd_reamrk,
                'requestorder_hd_duedate' => $request->requestorder_hd_duedate,
                'update_at' => Carbon::now(),
                'person_at' =>  Auth::user()->username,
                'requestorder_status_id' => 5
            ]);
            foreach($request->pd_code as $key => $val){
                $pd = Product::where('pd_code',$val)->first();              
                $dt = DB::table('requestorder_dt')->insert([
                    'requestorder_hd_id' => $id,
                    'pd_code' => $pd->pd_code,
                    'pd_name' => $pd->pd_name,
                    'pd_unit' => $pd->pd_unit,
                    'pd_group' => $pd->pd_group,
                    'pd_stc' => $pd->pd_stc,
                    'pd_price' => $pd->pd_price,
                    'requestorder_dt_qty' => $request->pd_qty[$key],
                    'requestorder_dt_flag' => true,
                    'create_at' => Carbon::now(),
                    'person_at' => Auth::user()->username
                ]);
            }
            // DB::commit();
            $ck = DB::table('requestorder_dt')
            ->where('requestorder_hd_id',$id)
            ->where('requestorder_dt_flag',true)
            ->get();
            foreach ($ck as $key => $value) {
                $up = DB::table('requestorder_dt')
                ->where('requestorder_dt_id',$value->requestorder_dt_id)
                ->update([
                    'requestorder_dt_listno' => $key+1
                ]);
            }
            DB::commit();
            return redirect()->route('requestorder.index')->with('success', 'บันทึกเรียบร้อย');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->route('requestorder.index')->with('error', 'บันทึกไม่สำเร็จ');
        }
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

    public function getProduct(Request $request)
    {
        $pd = Product::where('id',$request->id)->first();
        return response()->json([
            'pd' => $pd,
        ]);
    }

    public function cancelSku(Request $request)
    {
        $sku = $request->ref;
        $update = DB::table('requestorder_dt')->where('requestorder_dt_id', $sku)->update([
            'requestorder_dt_flag' => false,
            'update_at' => Carbon::now(),
            'person_at' =>  Auth::user()->username
        ]);
        return response()->json([
            'status' => true
        ]);
    }

    public function cancelDoc(Request $request)
    {
        $id = $request->refid;
        $update = DB::table('requestorder_hd')->where('requestorder_hd_id', $id)->update([
            'requestorder_status_id' => 2,
            'update_at' => Carbon::now(),
            'person_at' =>  Auth::user()->username
        ]);
        return response()->json([
            'status' => true
        ]);
    }

    public function RequestorderList(Request $request)
    {
        if(Auth::user()->id == 1){
            $hd = DB::table('vw_requestorder_pricetotal')
            ->leftjoin('customers','vw_requestorder_pricetotal.arcode','=','customers.customer_code')
            ->get();
            $sum = DB::table('vw_requestorder_pricetotal')
            ->sum('total');
        }
        else {
            $hd = DB::table('vw_requestorder_pricetotal')
            ->leftjoin('customers','vw_requestorder_pricetotal.arcode','=','customers.customer_code')
            ->where('vw_requestorder_pricetotal.requestorder_hd_sale',Auth::user()->username)
            ->get();
            $sum = DB::table('vw_requestorder_pricetotal')
            ->where('requestorder_hd_sale',Auth::user()->username)
            ->sum('total');
        }
        return view('reportsale.form-report-requestorder', compact('hd','sum'));
    }

    public function getOrderBacklog(Request $request)
    {
        $product = DB::table('api_saleorder_backlog')
        ->where('ARCODE',$request->id)
        ->selectRaw("ITEMCODE")
        ->selectRaw("ITEMNAME")
        ->selectRaw("SUM(REMAINQTY) as REMAINQTY")
        ->groupBy('ITEMCODE','ITEMNAME')
        ->get();
        $bill =DB::table('vw_billorder_pricetotal')
        ->where('arcode',$request->id)
        ->first();
        return response()->json(
            [
                'status' => true,
                'product' => $product,
                'bill' => $bill
            ]
        );
    }
}
