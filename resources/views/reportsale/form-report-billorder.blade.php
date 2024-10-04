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
                <h3 class="card-title" style="font-weight: bold">เปิดบิลย้อนหลัง 30 วัน</h3><br>
                <div style="overflow-x:auto;">
                    <table id="tb_job" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>เลขที่บิล</th>
                                <th>ลูกค้า</th>
                                <th>สินค้า</th>
                                <th>จำนวน</th>
                                <th>ยอดเงิน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hd as $item)
                                <tr>
                                    <td>{{$item->docdate}}</td>
                                    <td>{{$item->docno}}</td>
                                    <td>{{$item->arname}}</td>
                                    <td>{{$item->itemcode}}/{{$item->itemname}}</td>
                                    <td>{{number_format($item->qty,2)}}</td>
                                    <td>{{number_format($item->netamount,2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h3 class="card-title" style="font-weight: bold">ยอดรวมลูกค้าเปิดบิลภายใน 7 วัน</h3><br>
                <div style="overflow-x:auto;">
                    <table id="tb_job1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ลูกค้า</th>
                                @foreach ($groupedByDay as $day => $items)
                                    <th>{{\Carbon\Carbon::parse($day)->format('d/m/Y')}}</th>
                                @endforeach
                                <th>รวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // ตัวแปรเพื่อเก็บยอดรวมทั้งเดือน
                                $columnTotals = [];
                            @endphp
                            @foreach ($hd1->groupBy('arname') as $customerName => $itemsByCustomer)
                                <tr>                             
                                    <td>{{ $customerName }}</td>
                                    @php
                                        $rowTotal = 0; // ตัวแปรเพื่อเก็บยอดรวมของลูกค้า
                                    @endphp
                                    @foreach ($groupedByDay as $day => $items) 
                                        @php
                                            // ค้นหา netamount ของลูกค้าในแต่ละเดือน
                                            $purchase = $itemsByCustomer->firstWhere('docdate', $day);
                                            $amount = $purchase ? $purchase->netamount : 0;
                                            $rowTotal += $amount; // เพิ่มยอดรวมรายลูกค้า
                                            
                                            // เพิ่มยอดรวมใน columnTotals
                                            if (!isset($columnTotals[$day])) {
                                                $columnTotals[$day] = 0; // กำหนดค่าเริ่มต้นถ้ายังไม่มี
                                            }
                                            $columnTotals[$day] += $amount; // เพิ่มยอดรวมของเดือน
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
                                @foreach ($groupedByDay as $day => $items)
                                    <td>{{ number_format($columnTotals[$day] ?? 0, 2) }}</td> <!-- แสดงยอดรวมของเดือน -->
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
        $('#tb_job').DataTable({
            "pageLength": 20,
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
                [0, "desc"]
            ],
        })
    });
    $(document).ready(function() {
    $('#tb_job1').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
    ],
    "order": [[ 1, "desc" ]],        
    })
});
</script>
@endpush