<div><br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    {{-- <a href="{{route('customer.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มลูกค้า</a> --}}
                </div>
                <div class="col-sm-6">
                    <p class="float-sm-right">จัดการลูกค้า/ลูกค้า</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>สถานะ</th>
                <th>รหัสลูกค้า</th>
                <th>ชื่อลูกค้า</th>
                <th>พนักงานขาย</th>
                <th>จังหวัด</th>
                <th>กลุ่มลูกค้า</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($cust as $cust)
                      <tr>
                        <td>
                          @if ($cust->customer_flag)
                          <span class="badge bg-success">ใช้งาน</span>
                          @else
                          <span class="badge bg-danger">ไม่ใช้งาน</span>
                          @endif
                        </td>
                          <td>{{$cust->customer_code}}</td>
                          <td>{{$cust->customer_name}}</td>
                          <td>{{$cust->sale_name}}</td>
                          <td>{{$cust->province_name}}</td>
                          <td>{{$cust->custgroup_name}}</td>
                          <td>
                            <a href="{{route('customer.update',$cust->id)}}" 
                              class="btn btn-sm btn-warning" >
                              <i class="fas fa-edit"></i>
                            </a>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>สถานะ</th>
                <th>รหัสลูกค้า</th>
                <th>ชื่อลูกค้า</th>
                <th>พนักงานขาย</th>
                <th>จังหวัด</th>
                <th>กลุ่มลูกค้า</th>
                <th></th>
              </tr>
              </tfoot>
            </table>
          </div>        
        </div>
        <!-- /.card-body -->
      </div>
</div>
