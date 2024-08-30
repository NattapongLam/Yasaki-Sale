@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title" style="font-weight: bold">สร้างใบสั่งจอง</h3><br><hr>
                <div class="col-md-12">                 
                    <div class="row">
                        <div class="col-12">
                            <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('requestorder.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body" style="background: #F8FCFC;">
                            <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="requestorder_hd_date">วันที่</label>
                                    <input type="date" class="form-control @error('requestorder_hd_date') is-invalid @enderror" id="requestorder_hd_date" name="requestorder_hd_date" value="{{ date('Y-m-d') }}" readonly>
                                    @error('requestorder_hd_date')
                                    <div id="requestorder_hd_date_validation" class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="requestorder_hd_docuno">เลขที่เอกสาร</label>
                                    <input type="text" class="form-control @error('requestorder_hd_docuno') is-invalid @enderror" id="requestorder_hd_docuno" name="requestorder_hd_docuno" value="{{$docs}}" readonly>
                                    <input type="hidden" id="requestorder_hd_number" name="requestorder_hd_number" value="{{$docs_number}}">
                                    @error('requestorder_hd_docuno')
                                    <div id="requestorder_hd_docuno_validation" class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="requestorder_hd_sale">รายชื่อ SALE</label>
                                    <select class="form-control @error('requestorder_hd_sale') is-invalid @enderror" id="requestorder_hd_sale" name="requestorder_hd_sale" required autofocus>
                                        @foreach ($sale as $sale)
                                        <option value="{{$sale->sa_code}}">{{$sale->sa_name}}</option>
                                        @endforeach                                     
                                    </select>
                                    @error('requestorder_hd_docuno')
                                    <div id="requestorder_hd_docuno_validation" class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="requestorder_hd_duedate">วันที่ต้องการให้ส่ง</label>
                                    <input type="date" class="form-control @error('requestorder_hd_duedate') is-invalid @enderror" id="requestorder_hd_duedate" name="requestorder_hd_duedate" value="{{ date('Y-m-d') }}" required autofocus>
                                    @error('requestorder_hd_duedate')
                                    <div id="requestorder_hd_duedate_validation" class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="customer_code">ลูกค้า</label>
                                        <select class="form-control select2bs4 @error('customer_code') is-invalid @enderror" id="customer_code" name="customer_code" required autofocus>
                                            <option value="0">ชื่อร้านค้า</option>
                                            @foreach ($cust as $cust)
                                            <option value="{{$cust->customer_code}}">{{$cust->customer_name}} ยอดในเดือน : {{number_format($cust->total)}}</option>
                                            @endforeach                                     
                                        </select>
                                        @error('customer_code')
                                        <div id="customer_code_validation" class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="requestorder_hd_reamrk">หมายเหตุ</label>
                                        <textarea class="form-control" id="requestorder_hd_reamrk" name="requestorder_hd_reamrk"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ลำดับ</th>
                                            <th class="text-center">สินค้า</th>
                                            <th class="text-center">จำนวน</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tb_productlist">
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success">
                                        บันทึกเอกสาร
                                     </button>
                                </div>
                            </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="card-body">
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
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                      <div class="table-responsive">
                                          <table id="tb_job1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                              <th class="text-center">เพิ่ม</th>
                                              <th class="text-center">รูปสินค้า</th>
                                              <th class="text-center">สินค้า</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stc1 as $stc1)
                                                    <tr>    
                                                        <td class="text-center"><img src="{{asset('images/accept.png')}}" style="width: 30px" onclick="addTolist({{$stc1->id}})"></td>                                         
                                                        <td class="text-center">
                                                          <a href="{{asset('/images/products/'.$stc1->pd_pic1)}}" target="_blank">
                                                              <img width="100px" src="{{asset('/images/products/'.$stc1->pd_pic1)}}">
                                                          </a>                        
                                                        </td>
                                                        <td>{{$stc1->pd_code}}/{{$stc1->pd_name}} (คงเหลือ:{{number_format($stc1->pd_stc,2)}})</td>                      
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
                                                <th class="text-center">เพิ่ม</th>
                                                <th class="text-center">รูปสินค้า</th>
                                                <th class="text-center">สินค้า</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stc2 as $stc2)
                                                    <tr>          
                                                        <td class="text-center"><img src="{{asset('images/accept.png')}}" style="width: 30px" onclick="addTolist({{$stc2->id}})"></td>                                      
                                                        <td class="text-center">
                                                          <a href="{{asset('/images/products/'.$stc2->pd_pic1)}}" target="_blank">
                                                              <img width="100px" src="{{asset('/images/products/'.$stc2->pd_pic1)}}">
                                                          </a>                        
                                                        </td>
                                                        <td>{{$stc2->pd_code}}/{{$stc2->pd_name}} (คงเหลือ:{{number_format($stc2->pd_stc,2)}})</td>                       
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
                                                <th class="text-center">เพิ่ม</th>
                                                <th class="text-center">รูปสินค้า</th>
                                                <th class="text-center">สินค้า</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stc3 as $stc3)
                                                    <tr>       
                                                        <td class="text-center"><img src="{{asset('images/accept.png')}}" style="width: 30px" onclick="addTolist({{$stc3->id}})"></td>                                       
                                                        <td class="text-center">
                                                            <a href="{{asset('/images/products/'.$stc3->pd_pic1)}}" target="_blank">
                                                                <img width="100px" src="{{asset('/images/products/'.$stc3->pd_pic1)}}">
                                                            </a>                        
                                                          </td>
                                                          <td>{{$stc3->pd_code}}/{{$stc3->pd_name}} (คงเหลือ:{{number_format($stc3->pd_stc,2)}})</td>                      
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
                                                <th class="text-center">เพิ่ม</th>
                                                <th class="text-center">รูปสินค้า</th>
                                                <th class="text-center">สินค้า</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stc4 as $stc4)
                                                    <tr>              
                                                        <td class="text-center"><img src="{{asset('images/accept.png')}}" style="width: 30px" onclick="addTolist({{$stc4->id}})"></td>                               
                                                        <td class="text-center">
                                                            <a href="{{asset('/images/products/'.$stc4->pd_pic1)}}" target="_blank">
                                                                <img width="100px" src="{{asset('/images/products/'.$stc4->pd_pic1)}}">
                                                            </a>                        
                                                          </td>
                                                          <td>{{$stc4->pd_code}}/{{$stc4->pd_name}} (คงเหลือ:{{number_format($stc4->pd_stc,2)}})</td>                       
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
                                                <th class="text-center">เพิ่ม</th>
                                                <th class="text-center">รูปสินค้า</th>
                                                <th class="text-center">สินค้า</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stc5 as $stc5)
                                                    <tr>    
                                                        <td class="text-center"><img src="{{asset('images/accept.png')}}" style="width: 30px" onclick="addTolist({{$stc5->id}})"></td>                                         
                                                        <td class="text-center">
                                                            <a href="{{asset('/images/products/'.$stc5->pd_pic1)}}" target="_blank">
                                                                <img width="100px" src="{{asset('/images/products/'.$stc5->pd_pic1)}}">
                                                            </a>                        
                                                          </td>
                                                          <td>{{$stc5->pd_code}}/{{$stc5->pd_name}} (คงเหลือ:{{number_format($stc5->pd_stc,2)}})</td>                           
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
                                                <th class="text-center">เพิ่ม</th>
                                                <th class="text-center">รูปสินค้า</th>
                                                <th class="text-center">สินค้า</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stc6 as $stc6)
                                                    <tr>        
                                                        <td class="text-center"><img src="{{asset('images/accept.png')}}" style="width: 30px" onclick="addTolist({{$stc6->id}})"></td>                                     
                                                        <td class="text-center">
                                                            <a href="{{asset('/images/products/'.$stc6->pd_pic1)}}" target="_blank">
                                                                <img width="100px" src="{{asset('/images/products/'.$stc6->pd_pic1)}}">
                                                            </a>                        
                                                          </td>
                                                          <td>{{$stc6->pd_code}}/{{$stc6->pd_name}} (คงเหลือ:{{number_format($stc6->pd_stc,2)}})</td>                         
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
                                                <th class="text-center">เพิ่ม</th>
                                                <th class="text-center">รูปสินค้า</th>
                                                <th class="text-center">สินค้า</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stc7 as $stc7)
                                                    <tr>     
                                                        <td class="text-center"><img src="{{asset('images/accept.png')}}" style="width: 30px" onclick="addTolist({{$stc7->id}})"></td>                                        
                                                        <td class="text-center">
                                                            <a href="{{asset('/images/products/'.$stc7->pd_pic1)}}" target="_blank">
                                                                <img width="100px" src="{{asset('/images/products/'.$stc7->pd_pic1)}}">
                                                            </a>                        
                                                          </td>
                                                          <td>{{$stc7->pd_code}}/{{$stc7->pd_name}} (คงเหลือ:{{number_format($stc7->pd_stc,2)}})</td>                         
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
                                                <th class="text-center">เพิ่ม</th>
                                                <th class="text-center">รูปสินค้า</th>
                                                <th class="text-center">สินค้า</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stc8 as $stc8)
                                                    <tr>    
                                                        <td class="text-center"><img src="{{asset('images/accept.png')}}" style="width: 30px" onclick="addTolist({{$stc8->id}})"></td>                                         
                                                        <td class="text-center">
                                                            <a href="{{asset('/images/products/'.$stc8->pd_pic1)}}" target="_blank">
                                                                <img width="100px" src="{{asset('/images/products/'.$stc8->pd_pic1)}}">
                                                            </a>                        
                                                          </td>
                                                          <td>{{$stc8->pd_code}}/{{$stc8->pd_name}} (คงเหลือ:{{number_format($stc8->pd_stc,2)}})</td>                       
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
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script>
$(function () {
$('.select2').select2()
$('.select2bs4').select2({
    theme: 'bootstrap4'
})
});
$(document).ready(function() {
    $('#tb_job1').DataTable({
        "pageLength": 5,
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
$(document).ready(function() {
    $('#tb_job2').DataTable({
        "pageLength": 5,
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
$(document).ready(function() {
    $('#tb_job3').DataTable({
        "pageLength": 5,
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
$(document).ready(function() {
    $('#tb_job4').DataTable({
        "pageLength": 5,
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
$(document).ready(function() {
    $('#tb_job5').DataTable({
        "pageLength": 5,
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
$(document).ready(function() {
    $('#tb_job6').DataTable({
        "pageLength": 5,
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
$(document).ready(function() {
    $('#tb_job7').DataTable({
        "pageLength": 5,
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
$(document).ready(function() {
    $('#tb_job8').DataTable({
        "pageLength": 5,
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
addTolist = (id) => {
    console.log(id)
    $.ajax({
        url: "{{ url('/getProduct') }}",
        type: "POST",
        data: {
            id: id,
            _token: '{{ csrf_token() }}'
        },
        dataType: "json",
        success: function(data) {               
            $numbertd = $('#tb_productlist tr').length + 1;
            $('#tb_productlist').append(`
            <tr style="background-color:#F8F8FF" class="${data.pd.id}">                 
                <td class="text-center">
                    <input type="hidden" class="list_product_id" name="pd_id[]" value="${data.pd.id}">
                    <input type="hidden" class="list_product_id" name="pd_code[]" value="${data.pd.pd_code}">
                    ${$numbertd}
                </td>   
                <td class="text-center">${data.pd.pd_code}/${data.pd.pd_name}</td>
                <td class="text-center"><input type="number" class="form-control" name="pd_qty[]" value="0"></td>                  
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeTolist('${data.pd.id}')"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            `)                                                         
        }
    }) 
}
removeTolist = (reftr) => {
$('.' + reftr).remove()
}   
</script>
@endpush