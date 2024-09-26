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
                <h3 class="card-title" style="font-weight: bold">ยอดขาย</h3><br><hr>
                <div class="row">
                    <div class="col-12">
                        <!-- Chart Canvas -->
                        <canvas id="myLineChart" width="400" height="200"></canvas>                     
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ยอดปีก่อนหน้า</th>
                                        <th>ยอดปีปัจจุบัน</th>
                                        <th>%</th>
                                        <th>ยอดค้าง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hd3 as $item)
                                        <tr>
                                            <td>{{number_format($item->old_netamount,2)}}</td>
                                            <td>{{number_format($item->new_netamount,2)}}</td>
                                            <td>{{number_format($item->per_netamount,2)}}</td>
                                            <td>{{number_format($item->backlogprice,2)}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <h5 class="card-title" style="font-weight: bold">กลุ่มสินค้า</h5>
                        <!-- Bar chart canvas -->
                        <canvas id="myBarChart" width="400" height="200"></canvas>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>กลุ่มสินค้า</th>
                                        <th>ยอดปีก่อนหน้า</th>
                                        <th>ยอดปีปัจจุบัน</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hd1 as $item)
                                        <tr>
                                            <td>{{$item->pdgp_name}}</td>
                                            <td>{{number_format($item->old_netamount,2)}}</td>
                                            <td>{{number_format($item->new_netamount,2)}}</td>
                                            <td>{{number_format($item->per_netamount,2)}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <h5 class="card-title" style="font-weight: bold">จังหวัด</h5>
                        <canvas id="myBarChart1"></canvas>
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
                        <canvas id="myBarChart2"></canvas>
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
                                @foreach ($hd4 as $item)
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
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    // ดึงข้อมูลจาก Laravel (แปลงเป็น JSON)
    var months = @json($hd5->pluck('month'));
    var oldData = @json($hd5->pluck('old_netamount'));
    var newData = @json($hd5->pluck('new_netamount'));

    // ฟังก์ชันคำนวณยอดสะสม
    function calculateCumulative(data) {
        var cumulativeData = [];
        var sum = 0;
        data.forEach(function(value) {
            sum += parseFloat(value);
            cumulativeData.push(sum);
        });
        return cumulativeData;
    }

    // คำนวณยอดสะสม
    var cumulativeOldData = calculateCumulative(oldData);
    var cumulativeNewData = calculateCumulative(newData);

    var ctx = document.getElementById('myLineChart').getContext('2d');

    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months, // แสดงชื่อเดือนในแกน X
            datasets: [
                {
                    label: 'ยอดสะสมปีก่อนหน้า',
                    data: cumulativeOldData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                },
                {
                    label: 'ยอดสะสมปีปัจจุบัน',
                    data: cumulativeNewData,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'เดือน'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'ยอดขายสะสม (บาท)'
                    }
                }
            }
        }
    });
        // ดึงข้อมูลจาก Laravel (แปลงเป็น JSON)
    var productGroups = @json($hd1->pluck('pdgp_name'));
    var oldData = @json($hd1->pluck('old_netamount'));
    var newData = @json($hd1->pluck('new_netamount'));

    var ctx = document.getElementById('myBarChart').getContext('2d');

    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: productGroups, // กลุ่มสินค้าในแกน X
            datasets: [
                {
                    label: 'ยอดปีก่อนหน้า',
                    data: oldData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // สีของแถบกราฟ
                    borderColor: 'rgba(75, 192, 192, 1)', // สีขอบแถบกราฟ
                    borderWidth: 1
                },
                {
                    label: 'ยอดปีปัจจุบัน',
                    data: newData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)', // สีของแถบกราฟ
                    borderColor: 'rgba(153, 102, 255, 1)', // สีขอบแถบกราฟ
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'กลุ่มสินค้า'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'ยอดขาย (บาท)'
                    }
                }
            }
        }
    });
        // เก็บข้อมูลจาก PHP สำหรับจังหวัด, ยอดปีก่อนหน้า และ ยอดปีปัจจุบัน
        var labels = [
        @foreach($hd2 as $item)
            "{{$item->province_name}}", 
        @endforeach
    ];

    var oldData = [
        @foreach($hd2 as $item)
            {{$item->old_netamount}}, 
        @endforeach
    ];

    var newData = [
        @foreach($hd2 as $item)
            {{$item->new_netamount}}, 
        @endforeach
    ];

    // สร้าง Bar Chart โดยใช้ Chart.js
    var ctx = document.getElementById('myBarChart1').getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels, // จังหวัด
            datasets: [
                {
                    label: 'ยอดปีก่อนหน้า',
                    data: oldData, // ยอดปีก่อนหน้า
                    backgroundColor: 'rgba(54, 162, 235, 0.6)', // สี bar สำหรับปีก่อนหน้า
                    borderColor: 'rgba(54, 162, 235, 1)', // สีขอบ bar
                    borderWidth: 1
                },
                {
                    label: 'ยอดปีปัจจุบัน',
                    data: newData, // ยอดปีปัจจุบัน
                    backgroundColor: 'rgba(255, 99, 132, 0.6)', // สี bar สำหรับปีปัจจุบัน
                    borderColor: 'rgba(255, 99, 132, 1)', // สีขอบ bar
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // ให้แกน Y เริ่มต้นที่ 0
                }
            },
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw.toLocaleString(); // แสดงตัวเลขแบบคั่นด้วย comma
                        }
                    }
                }
            }
        }
    });
    document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('myBarChart2').getContext('2d');

    // ข้อมูลจาก Laravel ที่จะถูกส่งไปยังกราฟ
    var labels = [
        @foreach($hd6->unique('province_name') as $item)
            '{{$item->province_name}}',
        @endforeach
    ];

    var datasets = [
        @foreach($hd6->unique('pdgp_name') as $group)
            {
                label: '{{$group->pdgp_name}}', // ชื่อกลุ่มสินค้า
                data: [
                    @foreach($hd6->where('pdgp_name', $group->pdgp_name) as $item)
                        {{ $item->new_netamount }},
                    @endforeach
                ],
                backgroundColor: '{{ sprintf("#%06X", mt_rand(0, 0xFFFFFF)) }}', // สุ่มสี
                borderColor: '{{ sprintf("#%06X", mt_rand(0, 0xFFFFFF)) }}',
                borderWidth: 1
            },
        @endforeach
    ];

    // สร้างกราฟ
    var myChart = new Chart(ctx, {
        type: 'bar',  // ประเภทของกราฟ
        data: {
            labels: labels,  // ใช้ชื่อจังหวัดเป็นแกน X
            datasets: datasets  // ข้อมูลแต่ละกลุ่มสินค้า
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',  // แสดงตารางข้อมูล
                },
                title: {
                    display: true,
                    text: 'ยอดขายสินค้าแต่ละกลุ่มในแต่ละจังหวัด'
                }
            },
            scales: {
                x: {
                    stacked: true  // ทำให้ Bar Chart เป็นแบบซ้อนกัน
                },
                y: {
                    beginAtZero: true,
                    stacked: true  // ทำให้ Bar Chart เป็นแบบซ้อนกัน
                }
            }
        }
    });
});
</script>
@endpush