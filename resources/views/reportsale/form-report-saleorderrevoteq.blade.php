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
                <h3 class="card-title" style="font-weight: bold">ยอดขาย REVOTEQ เทียบปี/เดือน</h3><br><hr>
                <div class="row">
                    <div class="col-12">
                        <canvas id="myBarChart" width="400" height="200"></canvas>
                        <h6 class="text-center" style="font-weight: bold; color: red;"> ** หากจำนวนเดือนไหนไม่ชนะปีที่ก่อนหน้าจะขึ้นเป็นตัวอักษรสีแดง **</h6>
                        @if (Auth::user()->id == 1 || Auth::user()->id == 10 || Auth::user()->id == 11)
                        <div style="overflow-x:auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">พนักงานขาย</th>
                                        @foreach ($groupedByMonth as $month => $items)
                                            <th colspan="2" class="text-center">จำนวน(ชุด)ดือน {{$month}}</th> <!-- เพิ่ม colspan ตามจำนวนคอลัมน์ภายใต้เดือน -->
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($groupedByMonth as $month => $items)
                                            <th class="text-center">ปี66</th> <!-- คอลัมน์แรกภายใต้เดือน -->
                                            <th class="text-center">ปี67</th> <!-- คอลัมน์ที่สองภายใต้เดือน -->
                                        @endforeach
                                    </tr>
                                </thead>    
                                <tbody>
                                    <tbody>
                                        @foreach ($hd5->groupBy('sa_name') as $saleName => $itemsBySale)
                                        <tr>
                                            <td class="text-center">{{ $saleName}}</td>
                                            @foreach ($groupedByMonth as $month => $items) 
                                            @php
                                                // ค้นหา netamount ของลูกค้าในแต่ละเดือน
                                                $purchase = $itemsBySale->firstWhere('month', $month);
                                                $amount1 = $purchase ? $purchase->old_qty : 0;   
                                                $amount2 = $purchase ? $purchase->new_qty : 0;                                           
                                            @endphp
                                            @if ($amount1 > $amount2)
                                            <td class="text-center">{{ number_format($amount1, 2) }}</td>
                                            <td class="text-center" style="color: red">{{ number_format($amount2, 2) }}</td>
                                            @else
                                            <td class="text-center">{{ number_format($amount1, 2) }}</td>
                                            <td class="text-center">{{ number_format($amount2, 2) }}</td>
                                            @endif                                          
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </tbody>              
                            </table>
                        </div>
                        @else
                        <div style="overflow-x:auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">พนักงานขาย</th>
                                        @foreach ($groupedByMonth as $month => $items)
                                            <th colspan="2" class="text-center">จำนวน(ชุด)เดือน {{$month}}</th> <!-- เพิ่ม colspan ตามจำนวนคอลัมน์ภายใต้เดือน -->
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($groupedByMonth as $month => $items)
                                            <th class="text-center">ปี66</th> <!-- คอลัมน์แรกภายใต้เดือน -->
                                            <th class="text-center">ปี67</th> <!-- คอลัมน์ที่สองภายใต้เดือน -->
                                        @endforeach
                                    </tr>
                                </thead>    
                                <tbody>
                                    <tbody>
                                        @foreach ($hd5->groupBy('sa_name') as $saleName => $itemsBySale)
                                        <tr>
                                            <td class="text-center">{{ $saleName}}</td>
                                            @foreach ($groupedByMonth as $month => $items) 
                                            @php
                                                // ค้นหา netamount ของลูกค้าในแต่ละเดือน
                                                $purchase = $itemsBySale->firstWhere('month', $month);
                                                $amount1 = $purchase ? $purchase->old_qty : 0;   
                                                $amount2 = $purchase ? $purchase->new_qty : 0;                                           
                                            @endphp
                                            @if ($amount1 > $amount2)
                                            <td class="text-center">{{ number_format($amount1, 2) }}</td>
                                            <td class="text-center" style="color: red">{{ number_format($amount2, 2) }}</td>
                                            @else
                                            <td class="text-center">{{ number_format($amount1, 2) }}</td>
                                            <td class="text-center">{{ number_format($amount2, 2) }}</td>
                                            @endif                                          
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </tbody>              
                            </table>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>จังหวัด</th>
                                        <th>ยอดปีก่อนหน้า</th>
                                        <th>ยอดปีปัจจุบัน</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hd2 as $item)
                                        <tr>
                                            <td>{{$item->province_name}}</td>
                                            <td>{{number_format($item->old_netamount,2)}}</td>
                                            <td>{{number_format($item->new_netamount,2)}}</td>
                                            <td>{{number_format($item->per_netamount,2)}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <h5 class="card-title" style="font-weight: bold">ลูกค้า</h5><br>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ลูกค้า</th>
                                    <th>ยอดปีก่อนหน้า</th>
                                    <th>ยอดปีปัจจุบัน</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd3 as $item)
                                    <tr>
                                        <td>{{$item->customer_name}}</td>
                                        <td>{{number_format($item->old_netamount,2)}}</td>
                                        <td>{{number_format($item->new_netamount,2)}}</td>
                                        <td>{{number_format($item->per_netamount,2)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>       
                <div class="row">
                    <div class="table-responsive">
                        <table id="tb_job" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>สินค้า</th>
                                    <th>จำนวนปีก่อนหน้า</th>
                                    <th>จำนวนปีปัจจุบัน</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hd4 as $item)
                                    <tr>
                                        <td>{{$item->itemcode}}/{{$item->pd_name}}</td>
                                        <td>{{number_format($item->old_qty,2)}}</td>
                                        <td>{{number_format($item->new_qty,2)}}</td>
                                        <td>{{number_format($item->per_qty,2)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>             
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    $('#tb_job').DataTable({
        "pageLength": 10,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
    ],
    "order": [[ 2, "desc" ]],        
    })
});  ;
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('myBarChart').getContext('2d');

        // ข้อมูลจาก Laravel ที่จะถูกส่งไปยังกราฟ
        var labels = [
            @foreach($hd1 as $item)
                '{{$item->month}}',
            @endforeach
        ];

        var oldYearData = [
            @foreach($hd1 as $item)
                {{ $item->old_netamount }},
            @endforeach
        ];

        var newYearData = [
            @foreach($hd1 as $item)
                {{ $item->new_netamount }},
            @endforeach
        ];

        // สร้างกราฟ
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,  // ใช้ชื่อเดือนเป็นแกน X
                datasets: [
                    {
                        label: 'ยอดเดือนปีก่อนหน้า',
                        data: oldYearData,  // ข้อมูลยอดเดือนปีก่อนหน้า
                        backgroundColor: 'rgba(245, 39, 39, 1)',  // สีของ bar
                        borderColor: 'rgba(245, 39, 39, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'ยอดเดือนปีปัจจุบัน',
                        data: newYearData,  // ข้อมูลยอดเดือนปีปัจจุบัน
                        backgroundColor: 'rgba(39, 245, 39, 1)',  // สีของ bar
                        borderColor: 'rgba(39, 245, 39, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',  // แสดงตารางข้อมูลด้านบน
                    },
                    title: {
                        display: true,
                        text: 'ยอดขายเปรียบเทียบเดือนปีก่อนหน้าและปีปัจจุบัน'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true  // เริ่มต้นแกน Y ที่ค่า 0
                    }
                }
            }
        });
    });
</script>
@endpush