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
                <h3 class="card-title" style="font-weight: bold">REVOTEQ</h3><br><hr>
                <div class="row">
                    <div class="col-12">
                        <canvas id="myBarChart" width="400" height="200"></canvas>
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