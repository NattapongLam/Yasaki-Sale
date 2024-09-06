@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">   
    <div class="col-12">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  เลขที่: {{$hd->requestorder_hd_docuno}}
                  <small class="float-right">วันที่: {{\Carbon\Carbon::parse($hd->requestorder_hd_date)->format('d/m/Y')}}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-6 invoice-col">
                ลูกค้า:
                <address>
                  <strong>{{$hd->customer_name}}</strong>            
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-6 invoice-col">
                พนักงานขาย:
                <address>
                  <strong>{{$hd->sa_name}}</strong>
                </address>
              </div>
              <!-- /.col -->
              <!-- /.col -->
            </div>
            <!-- /.row -->
    
            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>สินค้า</th>
                    <th>จำนวน</th>
                  </tr>
                  </thead>
                  <tbody>  
                    @foreach ($dt as $item)
                        <tr>
                            <td>{{$item->requestorder_dt_listno}}</td>
                            <td>{{$item->pd_code}}/{{$item->pd_name}}</td>
                            <td>{{number_format($item->requestorder_dt_qty,2)}}</td>
                        </tr>
                    @endforeach         
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
    
            <div class="row">
              <!-- accepted payments column -->
              <div class="col-12">
                <p class="lead">หมายเหตุ:</p>
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    {{$hd->requestorder_hd_reamrk}}
                </p>
              </div>
            </div>
            <!-- /.row -->
          </div>
    </div>   
</div>
</div>
@endsection
@push('scriptjs')
<script>
</script>
@endpush