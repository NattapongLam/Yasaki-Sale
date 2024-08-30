<div><br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">                 
                </div>
                <div class="col-sm-6">
                    <p class="float-sm-right">จัดการสินค้า/สินค้า</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th class="text-center">สถานะ</th>
                <th></th>
                <th class="text-center">รหัสสินค้า</th>
                <th class="text-center">ชื่อสินค้า</th>
                <th class="text-center">กลุ่มสินค้า</th>
                <th class="text-center">หน่วยนับ</th>
                <th class="text-center">จำนวน</th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($pd as $pd)
                      <tr>
                          <td class="text-center">
                            @if ($pd->pd_flag)
                            <span class="badge bg-success">ใช้งาน</span>
                            @else
                            <span class="badge bg-danger">ไม่ใช้งาน</span>
                            @endif
                          </td>
                          <td class="text-center">
                            <a href="{{asset('/images/products/'.$pd->pd_pic1)}}" target="_blank">
                                <img width="100px" src="{{asset('/images/products/'.$pd->pd_pic1)}}">
                            </a>                        
                          </td>
                          <td>{{$pd->pd_code}}</td>
                          <td>{{$pd->pd_name}}</td>   
                          <td class="text-center">{{$pd->pd_group}}</td>   
                          <td class="text-center">{{$pd->pd_unit}}</td>   
                          <td class="text-center">{{number_format($pd->pd_stc,2)}}</td>                        
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th class="text-center">สถานะ</th>
                <th></th>
                <th class="text-center">รหัสสินค้า</th>
                <th class="text-center">ชื่อสินค้า</th>
                <th class="text-center">กลุ่มสินค้า</th>
                <th class="text-center">หน่วยนับ</th>
                <th class="text-center">จำนวน</th>
              </tr>
              </tfoot>
            </table>
          </div>        
        </div>
        <!-- /.card-body -->
      </div>
</div>
