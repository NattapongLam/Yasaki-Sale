@extends('layouts.main')
@section('content')
<style>
.listbox-container {
    width: 100%; /* ใช้ความกว้างเต็ม */
    max-height: 350px; /* กำหนดความสูงสูงสุด */
    overflow-y: auto; /* เปิดการเลื่อนในแนวตั้ง */
    padding: 1px;
    font-size: 17px; /* ปรับขนาดตัวอักษร */
    background-color: #F8F8FF; /* สีพื้นหลัง */
    border: 1px solid #ccc; /* ขอบ */
    border-radius: 1px; /* มุมโค้ง */
}

.listbox-item {
    display: flex; /* ใช้ Flexbox */
    align-items: center; /* จัดแนวกลางในแนวตั้ง */
    padding: 4px; /* ระยะห่าง */
    border-bottom: 2px solid #e0e0e0; /* ขอบด้านล่าง */
}

.listbox-item:last-child {
    border-bottom: none; /* ไม่ให้มีขอบด้านล่างสำหรับรายการสุดท้าย */
}

.listbox-select {
    margin-right: 5px; /* ระยะห่างจากช่องเลือก */
}

.listbox-image {
    margin-right: 5px; /* ระยะห่างจากรูป */
}

.product-img {
    width: 30px; /* ปรับขนาดภาพให้เล็กลง */
    height: auto; /* เก็บสัดส่วน */
}

@media (max-width: 600px) {
    .listbox-container {
        font-size: 13px; /* ปรับขนาดตัวอักษรเล็กลงสำหรับหน้าจอเล็ก */
    }
    .product-img {
        width: 15px; /* ปรับขนาดภาพให้เล็กลงสำหรับหน้าจอเล็ก */
    }
}
</style>
<div class="mt-4"><br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title" style="font-weight: bold">แก้ไขใบสั่งจอง</h3><br><hr>
                <div class="col-md-12">                 
                    <div class="row">
                        <div class="col-12">
                            <form id="frm_sub" method="POST" class="form-horizontal" action="{{ route('requestorder.update',$hd->requestorder_hd_id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body" style="background: #F8FCFC;">
                            <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="requestorder_hd_date">วันที่</label>
                                    <input type="text" class="form-control @error('requestorder_hd_date') is-invalid @enderror" id="requestorder_hd_date" name="requestorder_hd_date" value="{{$hd->requestorder_hd_date}}" readonly>
                                    @error('requestorder_hd_date')
                                    <div id="requestorder_hd_date_validation" class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="requestorder_hd_docuno">เลขที่เอกสาร</label>
                                    <input type="text" class="form-control @error('requestorder_hd_docuno') is-invalid @enderror" id="requestorder_hd_docuno" name="requestorder_hd_docuno" value="{{$hd->requestorder_hd_docuno}}" readonly>
                                    @error('requestorder_hd_docuno')
                                    <div id="requestorder_hd_docuno_validation" class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="requestorder_hd_sale">รายชื่อ SALE</label>
                                    <input type="text" class="form-control" id="requestorder_hd_sale" name="requestorder_hd_sale" value="{{$hd->sa_name}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="requestorder_hd_duedate">วันที่ต้องการให้ส่ง</label>
                                    <input type="date" class="form-control @error('requestorder_hd_duedate') is-invalid @enderror" id="requestorder_hd_duedate" name="requestorder_hd_duedate" value="{{ $hd->requestorder_hd_duedate }}" required autofocus>
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
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{$hd->customer_name}} ยอดในเดือน : {{number_format($hd->total)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="requestorder_hd_reamrk">หมายเหตุ</label>
                                        <textarea class="form-control" id="requestorder_hd_reamrk" name="requestorder_hd_reamrk">{{$hd->requestorder_hd_reamrk}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($bill)
                                <h5 style="color: red">เปิดบิลภายในเดือน : {{number_format($bill->netamount,2)}}</h5>
                                @endif
                            </div>
                            <div class="row">
                                @if ($product)
                                <h5 style="color: red">สินค้าค้างส่ง : </h5>
                                <table class="table">
                                    <tbody>
                                        @foreach ($product as $item)
                                        <tr>
                                            <td>{{$item->ITEMCODE}}/{{$item->ITEMNAME}}</td>
                                            <td>{{number_format($item->REMAINQTY,2)}}</td>
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                                @endif                                
                            </div>
                            <div class="row">
                                <label>รายการที่สั่งแล้ว</label>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ลำดับ</th>
                                            <th class="text-center">สินค้า</th>
                                            <th class="text-center">จำนวน</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dt as $key => $dt)
                                            <tr>
                                                <td class="text-center">{{$key+1}}</td>
                                                <td>{{$dt->pd_code}}/{{$dt->pd_name}}</td>
                                                <td class="text-center">{{$dt->requestorder_dt_qty}} {{$dt->pd_unit}}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn-sm btn-danger" onclick="cancelSku('{{ $dt->requestorder_dt_id }}')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            <div class="col-12">                            
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <table class="table table-sm table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">สินค้า</th>
                                                                <th class="text-center">จำนวน</th>
                                                                <th class="text-center"></th>
                                                            </tr>
                                                        </thead>                                   
                                                        <tbody id="tb_productlist">
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>        
                                                                <th colspan="2"></th>                                  
                                                                <th><p>ผลรวม: <span id="sum_total">0</span></p></th>
                                                            </tr>
                                                        </tfoot>                                  
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
                                        </div>
                                        <div class="col-12">
                                            <div class="card-body">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">VIP</a></li>    
                                                <li class="nav-item"><a class="nav-link" href="#activity1" data-toggle="tab">SUPER</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#activity2" data-toggle="tab">PREMIUM</a></li>                                   
                                                <li class="nav-item"><a class="nav-link" href="#timeline1" data-toggle="tab">ดิสฟ้า</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#timeline1_1" data-toggle="tab">ดิสทอง</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#timeline1_2" data-toggle="tab">REVOTEQ</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#timeline2" data-toggle="tab">ดุมจับสเตอร์</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#timeline3" data-toggle="tab">ดุมหน้าดิส</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#timeline4" data-toggle="tab">ดุมหลังดรัม</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#timeline5" data-toggle="tab">แผงเบรค</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#timeline6" data-toggle="tab">ดุมหน้าดรัม</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#timeline7" data-toggle="tab">ดุมหลังดิส</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#activity3" data-toggle="tab">แพ็คเขียว</a></li>  
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="activity">
                                                    <input type="text" id="searchBox1" placeholder="ค้นหาสินค้า..." onkeyup="filterList1()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList1">
                                                        @foreach ($stc1 as $stc1)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc1->id}}" value="{{$stc1->id}}" onchange="handleCheckboxChange(this, {{$stc1->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc1->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc1->pd_code}} {{$stc1->pd_name}} คงเหลือ:{{number_format($stc1->pd_stc,2)}}
                                                                    </p>
                                                                        @if ($stc1->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc1->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc1->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc1->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc1->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc1->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                                
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="activity1">
                                                    <input type="text" id="searchBox2" placeholder="ค้นหาสินค้า..." onkeyup="filterList2()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList2">
                                                        @foreach ($stc1_1 as $stc1_1)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc1_1->id}}" value="{{$stc1_1->id}}" onchange="handleCheckboxChange(this, {{$stc1_1->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc1_1->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc1_1->pd_code}} {{$stc1_1->pd_name}} คงเหลือ:{{number_format($stc1_1->pd_stc,2)}}
                                                                    </p>
                                                                        <!-- รูปสินค้า -->
                                                                        @if ($stc1_1->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc1_1->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc1_1->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc1_1->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc1_1->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc1_1->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                  </div>
                                                  <div class="tab-pane" id="activity2">
                                                    <input type="text" id="searchBox3" placeholder="ค้นหาสินค้า..." onkeyup="filterList3()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList3">
                                                        @foreach ($stc1_2 as $stc1_2)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc1_2->id}}" value="{{$stc1_2->id}}" onchange="handleCheckboxChange(this, {{$stc1_2->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc1_2->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc1_2->pd_code}} {{$stc1_2->pd_name}} คงเหลือ:{{number_format($stc1_2->pd_stc,2)}}
                                                                    </p>
                                                                        <!-- รูปสินค้า -->
                                                                        @if ($stc1_2->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc1_2->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc1_2->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc1_2->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc1_2->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc1_2->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                  </div>
                                                <div class="tab-pane" id="timeline1">    
                                                    <input type="text" id="searchBox4" placeholder="ค้นหาสินค้า..." onkeyup="filterList4()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList4">
                                                        @foreach ($stc2 as $stc2)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc2->id}}" value="{{$stc2->id}}" onchange="handleCheckboxChange(this, {{$stc2->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc2->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc2->pd_code}} {{$stc2->pd_name}} คงเหลือ:{{number_format($stc2->pd_stc,2)}}
                                                                    </p>
                                                                        <!-- รูปสินค้า -->
                                                                        @if ($stc2->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc2->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc2->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc2->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc2->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc2->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="timeline1_1">   
                                                    <input type="text" id="searchBox5" placeholder="ค้นหาสินค้า..." onkeyup="filterList5()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList5">
                                                        @foreach ($stc2_1 as $stc2_1)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc2_1->id}}" value="{{$stc2_1->id}}" onchange="handleCheckboxChange(this, {{$stc2_1->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc2_1->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc2_1->pd_code}} {{$stc2_1->pd_name}} คงเหลือ:{{number_format($stc2_1->pd_stc,2)}}
                                                                    </p>                                                                    <!-- รูปสินค้า -->
                                                                        @if ($stc2_1->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc2_1->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc2_1->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc2_1->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc2_1->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc2_1->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div> 
                                                  </div>
                                                  <div class="tab-pane" id="timeline1_2">    
                                                    <input type="text" id="searchBox6" placeholder="ค้นหาสินค้า..." onkeyup="filterList6()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList6">
                                                        @foreach ($stc2_2 as $stc2_2)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc2_2->id}}" value="{{$stc2_2->id}}" onchange="handleCheckboxChange(this, {{$stc2_2->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc2_2->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc2_2->pd_code}} {{$stc2_2->pd_name}} คงเหลือ:{{number_format($stc2_2->pd_stc,2)}}
                                                                    </p>
                                                                        <!-- รูปสินค้า -->
                                                                        @if ($stc2_2->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc2_2->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc2_2->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc2_2->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc2_2->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc2_2->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                  </div>
                                                <div class="tab-pane" id="timeline2">   
                                                    <input type="text" id="searchBox7" placeholder="ค้นหาสินค้า..." onkeyup="filterList7()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList7">
                                                        @foreach ($stc3 as $stc3)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc3->id}}" value="{{$stc3->id}}" onchange="handleCheckboxChange(this, {{$stc3->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc3->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc3->pd_code}} {{$stc3->pd_name}} คงเหลือ:{{number_format($stc3->pd_stc,2)}}
                                                                    </p>
                                                                        <!-- รูปสินค้า -->
                                                                        @if ($stc3->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc3->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc3->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc3->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc3->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc3->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div> 
                                                </div>
                                                <div class="tab-pane" id="timeline3">    
                                                    <input type="text" id="searchBox8" placeholder="ค้นหาสินค้า..." onkeyup="filterList8()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList8">
                                                        @foreach ($stc4 as $stc4)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc4->id}}" value="{{$stc4->id}}" onchange="handleCheckboxChange(this, {{$stc4->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc4->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc4->pd_code}} {{$stc4->pd_name}} คงเหลือ:{{number_format($stc4->pd_stc,2)}}
                                                                    </p>
                                                                        <!-- รูปสินค้า -->
                                                                        @if ($stc4->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc4->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc4->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc4->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc4->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc4->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div> 
                                                </div>
                                                <div class="tab-pane" id="timeline4">    
                                                    <input type="text" id="searchBox9" placeholder="ค้นหาสินค้า..." onkeyup="filterList9()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList9">
                                                        @foreach ($stc5 as $stc5)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc5->id}}" value="{{$stc5->id}}" onchange="handleCheckboxChange(this, {{$stc5->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc5->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc5->pd_code}} {{$stc5->pd_name}} คงเหลือ:{{number_format($stc5->pd_stc,2)}}
                                                                    </p>
                                                                        <!-- รูปสินค้า -->
                                                                        @if ($stc5->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc5->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc5->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc5->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc5->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc5->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div> 
                                                </div>
                                                <div class="tab-pane" id="timeline5">    
                                                    <input type="text" id="searchBox10" placeholder="ค้นหาสินค้า..." onkeyup="filterList10()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList10">
                                                        @foreach ($stc6 as $stc6)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc6->id}}" value="{{$stc6->id}}" onchange="handleCheckboxChange(this, {{$stc6->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc6->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc6->pd_code}} {{$stc6->pd_name}} คงเหลือ:{{number_format($stc6->pd_stc,2)}}
                                                                    </p>
                                                                        <!-- รูปสินค้า -->
                                                                        @if ($stc6->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc6->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc6->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc6->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc6->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc6->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div> 
                                                </div>
                                                <div class="tab-pane" id="timeline6">   
                                                    <input type="text" id="searchBox11" placeholder="ค้นหาสินค้า..." onkeyup="filterList11()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList11">
                                                        @foreach ($stc7 as $stc7)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc7->id}}" value="{{$stc7->id}}" onchange="handleCheckboxChange(this, {{$stc7->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc7->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc7->pd_code}} {{$stc7->pd_name}} คงเหลือ:{{number_format($stc7->pd_stc,2)}}
                                                                    </p>
                                                                        <!-- รูปสินค้า -->
                                                                        @if ($stc7->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc7->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc7->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc7->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc7->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc7->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div>  
                                                </div>
                                                <div class="tab-pane" id="timeline7">    
                                                    <input type="text" id="searchBox12" placeholder="ค้นหาสินค้า..." onkeyup="filterList12()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList12">
                                                        @foreach ($stc8 as $stc8)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc8->id}}" value="{{$stc8->id}}" onchange="handleCheckboxChange(this, {{$stc8->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc8->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc8->pd_code}} {{$stc8->pd_name}} คงเหลือ:{{number_format($stc8->pd_stc,2)}}
                                                                    </p>
                                                                        <!-- รูปสินค้า -->
                                                                        @if ($stc8->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc8->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc8->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc8->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc8->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc8->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif                              
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div> 
                                                  {{-- <div class="table-responsive">
                                                      <table id="tb_job8" class="table table-sm table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center">รูปสินค้า</th>
                                                            <th class="text-center">สินค้า</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($stc8 as $stc8)
                                                                <tr>                                                                       
                                                                    <td class="text-center">
                                                                        <a href="{{asset('/images/products/'.$stc8->pd_pic1)}}" target="_blank">
                                                                            <img width="20px" src="{{asset('/images/products/'.$stc8->pd_pic1)}}">
                                                                        </a>   
                                                                        <a href="{{asset('/images/products/'.$stc8->pd_pic2)}}" target="_blank">
                                                                            <img width="20px" src="{{asset('/images/products/'.$stc8->pd_pic2)}}">
                                                                        </a>  
                                                                        <a href="{{asset('/images/products/'.$stc8->pd_pic3)}}" target="_blank">
                                                                            <img width="20px" src="{{asset('/images/products/'.$stc8->pd_pic3)}}">
                                                                        </a>                             
                                                                      </td>
                                                                      <td>
                                                                        <p onclick="addTolist({{$stc8->id}})">
                                                                            {{$stc8->pd_code}}/{{$stc8->pd_name}} (คงเหลือ:{{number_format($stc8->pd_stc,2)}})
                                                                        </p>                                                            
                                                                    </td>                       
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                      </table>
                                                    </div>                        --}}
                                                </div>
                                                <div class="tab-pane" id="activity3">
                                                    <input type="text" id="searchBox2" placeholder="ค้นหาสินค้า..." onkeyup="filterList2()" class="form-control" style="margin-bottom: 5px;">
                                                    <div class="listbox-container"id="productList2">
                                                        @foreach ($stc1_3 as $stc1_3)
                                                            <div class="listbox-item">
                                                                <div class="listbox-select">
                                                                    <!-- ปุ่ม checkbox ที่เรียกฟังก์ชัน addTolist -->
                                                                    <input type="checkbox" class="select-product" id="checkbox-{{$stc1_3->id}}" value="{{$stc1_3->id}}" onchange="handleCheckboxChange(this, {{$stc1_3->id}})">
                                                                </div>                                                               
                                                                <div class="listbox-info">
                                                                    <!-- รายละเอียดสินค้า -->
                                                                    <p onclick="selectAndAddTolist({{$stc1_3->id}})" style="display: inline; margin-right: 10px;">
                                                                        {{$stc1_3->pd_code}} {{$stc1_3->pd_name}} คงเหลือ:{{number_format($stc1_3->pd_stc,2)}}
                                                                    </p>
                                                                    @if ($stc1_3->pd_pic1)
                                                                        <a href="{{asset('/images/products/'.$stc1_3->pd_pic1)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if($stc1_3->pd_pic2)
                                                                        <a href="{{asset('/images/products/'.$stc1_3->pd_pic2)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if ($stc1_3->pd_pic3)
                                                                        <a href="{{asset('/images/products/'.$stc1_3->pd_pic3)}}" target="_blank">
                                                                            <i class="fas fa-image" style="display: inline;"></i>
                                                                        </a>
                                                                        @endif     
                                                                </div>                                                         
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>                                      
                                    </div>                                                                 
                                </div>
                            </div>
                            </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(function () {
$('.select2').select2()
$('.select2bs4').select2({
    theme: 'bootstrap4'
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
$(document).ready(function() {
    $('#tb_job1_1').DataTable({
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
$(document).ready(function() {
    $('#tb_job1_2').DataTable({
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
$(document).ready(function() {
    $('#tb_job2').DataTable({
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
$(document).ready(function() {
    $('#tb_job2_1').DataTable({
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
$(document).ready(function() {
    $('#tb_job2_2').DataTable({
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
$(document).ready(function() {
    $('#tb_job3').DataTable({
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
$(document).ready(function() {
    $('#tb_job4').DataTable({
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
$(document).ready(function() {
    $('#tb_job5').DataTable({
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
$(document).ready(function() {
    $('#tb_job6').DataTable({
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
$(document).ready(function() {
    $('#tb_job7').DataTable({
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
$(document).ready(function() {
    $('#tb_job8').DataTable({
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
            let currentItemId = $('.list_product_id').toArray();
            console.log(currentItemId)
            if (currentItemId.map(item => item.value).includes(data.pd.pd_code)) {              
            }
            else{      
            $numbertd = $('#tb_productlist tr').length + 1;
            $('#tb_productlist').append(`
            <tr style="background-color:#F8F8FF" class="${data.pd.id}">                 
                <td class="text-center">
                    <input type="hidden" name="pd_id[]" value="${data.pd.id}">
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
        }
    }) 
}
function removeTolist(productId) {
    // ลบแถวจากตาราง
    $(`#tb_productlist .${productId}`).remove();

    // นำเครื่องหมายถูกออกจาก checkbox ที่เกี่ยวข้อง
    $(`#checkbox-${productId}`).prop('checked', false);
}
// removeTolist = (reftr) => {
// $('.' + reftr).remove()
// }   
cancelSku = (sku) => {
        // alert(sku)
        // confirm
        Swal.fire({
            title: 'ยืนยันการยกเลิก',
            text: "คุณต้องการยกเลิกใบสั่งซื้อนี้ใช่หรือไม่ ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'ใช่, ยกเลิก!',
            cancelButtonText: 'ไม่ใช่'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('/cancelSku') }}",
                    type: "post",
                    data: {
                        ref : sku,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(data) {


                        if (data.status == true || data.status == 'true') {
                            toastr.success('ยกเลิกสินค้าเรียบร้อย', 'Success', {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": "toast-bottom-right",
                                "showDuration": 500,
                                "hideDuration": 10,
                                "timeOut": 5000,
                                "extendedTimeOut": 1000,
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"

                            });

                            setTimeout(() => {
                                location.reload()
                            }, 1000);

                        }

                    }
                })

            }
        })


    }
    function calculateSum() {
    let sum = 0;
    $('input[name="pd_qty[]"]').each(function() {
        sum += parseFloat($(this).val()) || 0; // ถ้าค่าเป็น NaN จะให้เป็น 0
    });
    $('#sum_total').text(sum); // แสดงผลรวมใน element ที่คุณต้องการ
}
$(document).on('input', 'input[name="pd_qty[]"]', function() {
    calculateSum();
});
function handleCheckboxChange(checkbox, productId) {
    if (checkbox.checked) {
        // เมื่อ checkbox ถูกเลือก, เรียกฟังก์ชัน addTolist
        addTolist(productId);
    } else {
        // เมื่อ checkbox ถูกยกเลิกการเลือก
        removeTolist(productId); // ลบสินค้าจากรายการถ้าต้องการ
    }
}
function selectAndAddTolist(productId) {
    // ค้นหา checkbox ที่ตรงกับ productId
    let checkbox = document.getElementById(`checkbox-${productId}`);
    // ตรวจสอบว่าสามารถเลือก checkbox ได้หรือไม่
    if (checkbox) {
        checkbox.checked = true; // เลือก checkbox
    }
    // เรียกใช้ฟังก์ชัน addTolist
    addTolist(productId);
}
function filterList1() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox1');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList1');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList2() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox2');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList2');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList3() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox3');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList3');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList4() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox4');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList4');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList5() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox5');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList5');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList6() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox6');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList6');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList7() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox7');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList7');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList8() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox8');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList8');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList9() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox9');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList9');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList10() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox10');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList10');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList11() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox11');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList11');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
function filterList12() {
    // รับค่าจากช่องค้นหา
    let input = document.getElementById('searchBox12');
    let filter = input.value.toLowerCase();
    console.log("Filtering with:", filter);
    // รับรายการสินค้าทั้งหมด
    let productList = document.getElementById('productList12');
    let items = productList.getElementsByClassName('listbox-item');

    // วนลูปผ่านรายการสินค้าและแสดง/ซ่อนรายการตามค่าการค้นหา
    for (let i = 0; i < items.length; i++) {
        let code = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();
        let name = items[i].getElementsByTagName('p')[0].innerText.toLowerCase();

        if (code.includes(filter) || name.includes(filter)) {
            items[i].style.display = ""; // แสดงรายการที่ตรงกับการค้นหา
        } else {
            items[i].style.display = "none"; // ซ่อนรายการที่ไม่ตรงกับการค้นหา
        }
    }
}
</script>
@endpush