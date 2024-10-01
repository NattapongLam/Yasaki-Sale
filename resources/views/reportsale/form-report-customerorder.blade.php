@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">   
    <div class="col-12">
        <div class="card">
            @if(session('success'))
            <div class="alert" role="alert">
                <button type="button" class="btn btn-outline-success btn-sm btn-block">{{ session('success') }}</button>
            </div>
            @elseif(session('error'))
            <div class="alert" role="alert">
                <button type="button" class="btn btn-outline-danger btn-sm btn-block">{{ session('error') }}</button>
            </div>
            @endif
            <div class="card-body">                            
                    <form method="GET" action="{{ url('/report-customerorder') }}" class="row align-items-end">                      
                        <div class="col-md-2">
                            <label>วันที่</label>
                            <input type="date" class="form-control" name="start_date" value="{{ $start_date }}">
                        </div>
                        <div class="col-md-2">
                            <label>ถึง</label>
                            <input type="date" class="form-control" name="end_date" value="{{ $end_date }}">
                        </div>
                        <div class="col-md-6">
                            <label>ลูกค้า</label>
                            <select class="form-control select2" id="customer_code" name="customer_code">
                                <option value="0">ชื่อร้านค้า</option>
                                @foreach ($cust as $cust)
                                <option value="{{$cust->customer_code}}">{{$cust->customer_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary" style="margin-top: 24px;">ค้นหา</button>
                        </div>
                    </form><br>
                <div style="overflow-x:auto;">
                    @if ($hd)
                    @php
                    $totalQty = $hd->sum('netamount');
                    @endphp
                    <table class="table" id="tb_job"> 
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>เลขที่บิล</th>
                                <th>สินค้า</th>
                                <th>จำนวน</th>
                                <th>ราคาต่อหน่วย</th>
                                <th>ส่วนลด</th>
                                <th>รวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hd as $item)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($item->docdate)->format('d/m/Y')}}</td>
                                    <td>{{$item->docno}}</td>
                                    <td>{{$item->itemcode}} {{$item->itemname}}</td>
                                    <td>{{ number_format($item->qty,2)}} </td>
                                    <td>{{ number_format($item->price,2)}} </td>
                                    <td>{{$item->discountword}} </td>
                                    <td>{{ number_format($item->netamount,2)}} </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" class="text-right">ยอดรวม</th>
                                <th>{{number_format($totalQty, 2)}}</th>
                            </tr>
                        </tfoot>
                    </table>
                    @endif                  
                </div>
                <div class="row">
                    <h3 class="card-title" style="font-weight: bold">ประวัติการซื้อ</h3>
                </div> 
                <div style="overflow-x:auto;">   
<table id="tb_job1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ลูกค้า</th>
            @foreach ($groupedByMonth as $month => $items)
                <th>เดือน {{$month}}</th> <!-- แสดงผลเดือนใน thead โดยเรียงลำดับจากซ้ายไปขวา -->
            @endforeach
            <th>รวม</th> <!-- เพิ่มคอลัมน์สำหรับยอดรวม -->
        </tr>
    </thead>
    <tbody>
        @php
            // ตัวแปรเพื่อเก็บยอดรวมทั้งเดือน
            $columnTotals = [];
        @endphp
        @foreach ($hd1->groupBy('customer_name') as $customerName => $itemsByCustomer)
            <tr>                             
                <td>{{ $customerName }}</td>
                @php
                    $rowTotal = 0; // ตัวแปรเพื่อเก็บยอดรวมของลูกค้า
                @endphp
                @foreach ($groupedByMonth as $month => $items) 
                    @php
                        // ค้นหา netamount ของลูกค้าในแต่ละเดือน
                        $purchase = $itemsByCustomer->firstWhere('month', $month);
                        $amount = $purchase ? $purchase->netamount : 0;
                        $rowTotal += $amount; // เพิ่มยอดรวมรายลูกค้า
                        
                        // เพิ่มยอดรวมใน columnTotals
                        if (!isset($columnTotals[$month])) {
                            $columnTotals[$month] = 0; // กำหนดค่าเริ่มต้นถ้ายังไม่มี
                        }
                        $columnTotals[$month] += $amount; // เพิ่มยอดรวมของเดือน
                    @endphp
                    <td>{{ number_format($amount, 2) }}</td>
                @endforeach
                <td>{{ number_format($rowTotal, 2) }}</td> <!-- แสดงยอดรวมของลูกค้า -->
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>รวม</th> <!-- แสดงยอดรวมใน footer -->
            @foreach ($groupedByMonth as $month => $items)
                <td>{{ number_format($columnTotals[$month] ?? 0, 2) }}</td> <!-- แสดงยอดรวมของเดือน -->
            @endforeach
            <th>{{ number_format(array_sum($columnTotals), 2) }}</th> <!-- แสดงยอดรวมทั้งหมด -->
        </tr>
    </tfoot>
</table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script>
$(document).ready(function() {
    $('#customer_code').select2({
        placeholder: "ค้นหาร้านค้า",
        allowClear: true
    });
});
$(document).ready(function() {
    $('#customer_code').select2({
        placeholder: "ค้นหาร้านค้า",
        allowClear: true,
        theme: 'bootstrap4' // ใช้ธีม bootstrap4
    });
});
$(document).ready(function() {
    $('#tb_job').DataTable({
            "pageLength": 50,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            //order by
            "order": [
                [1, "desc"]
            ],
        })    
}); 
$(document).ready(function() {
    $('#tb_job1').DataTable({
        "pageLength": 50,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
    ],
    "order": [[ 0, "asc" ]],        
    })
});  
</script>
@endpush