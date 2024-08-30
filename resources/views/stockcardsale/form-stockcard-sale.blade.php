@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title" style="font-weight: bold">สต็อคสินค้า</h3><br><hr>
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">
                          <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">ผ้าเบรค</a></li>
                          <li class="nav-item"><a class="nav-link" href="#timeline1" data-toggle="tab">ดิสเบรค</a></li>
                          <li class="nav-item"><a class="nav-link" href="#timeline2" data-toggle="tab">ดุมจับสเตอร์</a></li>
                          <li class="nav-item"><a class="nav-link" href="#timeline3" data-toggle="tab">ดุมหน้าดิส</a></li>
                          <li class="nav-item"><a class="nav-link" href="#timeline4" data-toggle="tab">ดุมหลังดรัม</a></li>
                          <li class="nav-item"><a class="nav-link" href="#timeline5" data-toggle="tab">แผงเบรค</a></li>
                          <li class="nav-item"><a class="nav-link" href="#timeline6" data-toggle="tab">ดุมหน้าดรัม</a></li>
                          <li class="nav-item"><a class="nav-link" href="#timeline7" data-toggle="tab">ดุมหลังดิส</a></li>
                        </ul>
                      </div><!-- /.card-header -->
                      <div class="card-body">
                        <div class="tab-content">
                          <div class="active tab-pane" id="activity">
                            <div class="table-responsive">
                                <table id="tb_job1" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th></th>
                                    <th class="text-center">รหัสสินค้า</th>
                                    <th class="text-center">ชื่อสินค้า</th>
                                    <th class="text-center">หน่วยนับ</th>
                                    <th class="text-center">จำนวน</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($stc1 as $stc1)
                                          <tr>                                             
                                              <td class="text-center">
                                                <a href="{{asset('/images/products/'.$stc1->pd_pic1)}}" target="_blank">
                                                    <img width="100px" src="{{asset('/images/products/'.$stc1->pd_pic1)}}">
                                                </a>                        
                                              </td>
                                              <td>{{$stc1->pd_code}}</td>
                                              <td>{{$stc1->pd_name}}</td>     
                                              <td class="text-center">{{$stc1->pd_unit}}</td>   
                                              <td class="text-center">{{number_format($stc1->pd_stc,2)}}</td>                        
                                          </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>
                          </div>
                          <div class="tab-pane" id="timeline1">    
                            <div class="table-responsive">
                                <table id="tb_job2" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th></th>
                                    <th class="text-center">รหัสสินค้า</th>
                                    <th class="text-center">ชื่อสินค้า</th>
                                    <th class="text-center">หน่วยนับ</th>
                                    <th class="text-center">จำนวน</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($stc2 as $stc2)
                                          <tr>                                             
                                              <td class="text-center">
                                                <a href="{{asset('/images/products/'.$stc2->pd_pic1)}}" target="_blank">
                                                    <img width="100px" src="{{asset('/images/products/'.$stc2->pd_pic1)}}">
                                                </a>                        
                                              </td>
                                              <td>{{$stc2->pd_code}}</td>
                                              <td>{{$stc2->pd_name}}</td>     
                                              <td class="text-center">{{$stc2->pd_unit}}</td>   
                                              <td class="text-center">{{number_format($stc2->pd_stc,2)}}</td>                        
                                          </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>                      
                          </div>
                          <div class="tab-pane" id="timeline2">    
                            <div class="table-responsive">
                                <table id="tb_job3" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th></th>
                                    <th class="text-center">รหัสสินค้า</th>
                                    <th class="text-center">ชื่อสินค้า</th>
                                    <th class="text-center">หน่วยนับ</th>
                                    <th class="text-center">จำนวน</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($stc3 as $stc3)
                                          <tr>                                             
                                              <td class="text-center">
                                                <a href="{{asset('/images/products/'.$stc3->pd_pic1)}}" target="_blank">
                                                    <img width="100px" src="{{asset('/images/products/'.$stc3->pd_pic1)}}">
                                                </a>                        
                                              </td>
                                              <td>{{$stc3->pd_code}}</td>
                                              <td>{{$stc3->pd_name}}</td>     
                                              <td class="text-center">{{$stc3->pd_unit}}</td>   
                                              <td class="text-center">{{number_format($stc3->pd_stc,2)}}</td>                        
                                          </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>                       
                          </div>
                          <div class="tab-pane" id="timeline3">    
                            <div class="table-responsive">
                                <table id="tb_job4" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th></th>
                                    <th class="text-center">รหัสสินค้า</th>
                                    <th class="text-center">ชื่อสินค้า</th>
                                    <th class="text-center">หน่วยนับ</th>
                                    <th class="text-center">จำนวน</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($stc4 as $stc4)
                                          <tr>                                             
                                              <td class="text-center">
                                                <a href="{{asset('/images/products/'.$stc4->pd_pic1)}}" target="_blank">
                                                    <img width="100px" src="{{asset('/images/products/'.$stc4->pd_pic1)}}">
                                                </a>                        
                                              </td>
                                              <td>{{$stc4->pd_code}}</td>
                                              <td>{{$stc4->pd_name}}</td>     
                                              <td class="text-center">{{$stc4->pd_unit}}</td>   
                                              <td class="text-center">{{number_format($stc4->pd_stc,2)}}</td>                        
                                          </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>                       
                          </div>
                          <div class="tab-pane" id="timeline4">    
                            <div class="table-responsive">
                                <table id="tb_job5" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th></th>
                                    <th class="text-center">รหัสสินค้า</th>
                                    <th class="text-center">ชื่อสินค้า</th>
                                    <th class="text-center">หน่วยนับ</th>
                                    <th class="text-center">จำนวน</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($stc5 as $stc5)
                                          <tr>                                             
                                              <td class="text-center">
                                                <a href="{{asset('/images/products/'.$stc5->pd_pic1)}}" target="_blank">
                                                    <img width="100px" src="{{asset('/images/products/'.$stc5->pd_pic1)}}">
                                                </a>                        
                                              </td>
                                              <td>{{$stc5->pd_code}}</td>
                                              <td>{{$stc5->pd_name}}</td>     
                                              <td class="text-center">{{$stc5->pd_unit}}</td>   
                                              <td class="text-center">{{number_format($stc5->pd_stc,2)}}</td>                        
                                          </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>                       
                          </div>
                          <div class="tab-pane" id="timeline5">    
                            <div class="table-responsive">
                                <table id="tb_job6" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th></th>
                                    <th class="text-center">รหัสสินค้า</th>
                                    <th class="text-center">ชื่อสินค้า</th>
                                    <th class="text-center">หน่วยนับ</th>
                                    <th class="text-center">จำนวน</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($stc6 as $stc6)
                                          <tr>                                             
                                              <td class="text-center">
                                                <a href="{{asset('/images/products/'.$stc6->pd_pic1)}}" target="_blank">
                                                    <img width="100px" src="{{asset('/images/products/'.$stc6->pd_pic1)}}">
                                                </a>                        
                                              </td>
                                              <td>{{$stc6->pd_code}}</td>
                                              <td>{{$stc6->pd_name}}</td>     
                                              <td class="text-center">{{$stc6->pd_unit}}</td>   
                                              <td class="text-center">{{number_format($stc6->pd_stc,2)}}</td>                        
                                          </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>                       
                          </div>
                          <div class="tab-pane" id="timeline6">    
                            <div class="table-responsive">
                                <table id="tb_job7" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th></th>
                                    <th class="text-center">รหัสสินค้า</th>
                                    <th class="text-center">ชื่อสินค้า</th>
                                    <th class="text-center">หน่วยนับ</th>
                                    <th class="text-center">จำนวน</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($stc7 as $stc7)
                                          <tr>                                             
                                              <td class="text-center">
                                                <a href="{{asset('/images/products/'.$stc7->pd_pic1)}}" target="_blank">
                                                    <img width="100px" src="{{asset('/images/products/'.$stc7->pd_pic1)}}">
                                                </a>                        
                                              </td>
                                              <td>{{$stc7->pd_code}}</td>
                                              <td>{{$stc7->pd_name}}</td>     
                                              <td class="text-center">{{$stc7->pd_unit}}</td>   
                                              <td class="text-center">{{number_format($stc7->pd_stc,2)}}</td>                        
                                          </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>                       
                          </div>
                          <div class="tab-pane" id="timeline7">    
                            <div class="table-responsive">
                                <table id="tb_job8" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th></th>
                                    <th class="text-center">รหัสสินค้า</th>
                                    <th class="text-center">ชื่อสินค้า</th>
                                    <th class="text-center">หน่วยนับ</th>
                                    <th class="text-center">จำนวน</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($stc8 as $stc8)
                                          <tr>                                             
                                              <td class="text-center">
                                                <a href="{{asset('/images/products/'.$stc8->pd_pic1)}}" target="_blank">
                                                    <img width="100px" src="{{asset('/images/products/'.$stc8->pd_pic1)}}">
                                                </a>                        
                                              </td>
                                              <td>{{$stc8->pd_code}}</td>
                                              <td>{{$stc8->pd_name}}</td>     
                                              <td class="text-center">{{$stc8->pd_unit}}</td>   
                                              <td class="text-center">{{number_format($stc8->pd_stc,2)}}</td>                        
                                          </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                              </div>                       
                          </div>
                        </div>
                        <!-- /.tab-content -->
                      </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
    $('#tb_job1').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
         'print'
    ],
    "order": [[ 0, "asc" ]],        
    })
});   
$(document).ready(function() {
    $('#tb_job2').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
         'print'
    ],
    "order": [[ 0, "asc" ]],        
    })
});  
$(document).ready(function() {
    $('#tb_job3').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
         'print'
    ],
    "order": [[ 0, "asc" ]],        
    })
}); 
$(document).ready(function() {
    $('#tb_job4').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
         'print'
    ],
    "order": [[ 0, "asc" ]],        
    })
}); 
$(document).ready(function() {
    $('#tb_job5').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
         'print'
    ],
    "order": [[ 0, "asc" ]],        
    })
}); 
$(document).ready(function() {
    $('#tb_job6').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
         'print'
    ],
    "order": [[ 0, "asc" ]],        
    })
});
$(document).ready(function() {
    $('#tb_job7').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
         'print'
    ],
    "order": [[ 0, "asc" ]],        
    })
});
$(document).ready(function() {
    $('#tb_job8').DataTable({
        "pageLength": 20,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        dom: 'Bfrtip',
        buttons: [
         'print'
    ],
    "order": [[ 0, "asc" ]],        
    })
});
</script>
@endpush