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
                <h3 class="card-title" style="font-weight: bold">ยอดจองสินค้าประจำเดือน</h3><br>
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ลูกค้า</th>
                                <th>ยอดจอง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hd as $item)
                                <tr>
                                    <td>{{$item->customer_name}}</td>
                                    <td>{{number_format($item->total,2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>รวม</th>
                                <th>{{number_format($sum)}}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <h3 class="card-title" style="font-weight: bold">ยอดจองสินค้ารายเดือน</h3><br>
                <canvas id="myBarChart"></canvas>
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
                [1, "desc"]
            ],
        })
    });
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('myBarChart').getContext('2d');

        // ข้อมูลที่ดึงมาจากตาราง
        var labels = [
            @foreach ($hd1 as $item)
                '{{$item->month}}',
            @endforeach
        ];

        var dataValues = [
            @foreach ($hd1 as $item)
                {{$item->total}},
            @endforeach
        ];

        var myBarChart = new Chart(ctx, {
            type: 'bar', // ประเภทของกราฟ
            data: {
                labels: labels, // แกน X (เดือน)
                datasets: [{
                    label: 'ยอดจอง', // ชื่อชุดข้อมูล
                    data: dataValues, // ข้อมูลยอดจอง
                    backgroundColor: 'rgba(54, 162, 235, 0.6)', // สีของแท่งกราฟ
                    borderColor: 'rgba(54, 162, 235, 1)', // สีของขอบกราฟ
                    borderWidth: 1 // ความหนาของขอบกราฟ
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top' // ตำแหน่งของตารางแสดงข้อมูล
                    },
                    title: {
                        display: true,
                        text: 'ยอดจองในแต่ละเดือน' // ชื่อกราฟ
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true // เริ่มต้นจากศูนย์
                    }
                }
            }
        });
    });
</script>
@endpush