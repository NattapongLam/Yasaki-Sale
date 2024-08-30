<div><br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{route('employee.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มผู้ใช้งาน</a>
                </div>
                <div class="col-sm-6">
                    <p class="float-sm-right">จัดการระบบ/ผู้ใช้งาน</p>
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
                <th>ชื่อ - นามสกุล</th>
                <th>ผู้ใช้งาน</th>
                <th>เบอร์โทร</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($emp as $emp)
                      <tr>
                        <td>
                          @if ($emp->status)
                          <span class="badge bg-success">ใช้งาน</span>
                          @else
                          <span class="badge bg-danger">ไม่ใช้งาน</span>
                          @endif
                        </td>
                          <td>{{$emp->name}}</td>
                          <td>{{$emp->username}}</td>
                          <td>{{$emp->phone}}</td>
                          <td>
                            <a href="{{route('employee.update',$emp->id)}}" 
                              class="btn btn-sm btn-warning" >
                              <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{route('employee.rloe.permission',$emp->id)}}"
                              class="btn btn-sm btn-info">
                              <i class="fas fa-user"></i>
                            </a>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>สถานะ</th>
                <th>ชื่อ - นามสกุล</th>
                <th>ผู้ใช้งาน</th>
                <th>เบอร์โทร</th>
                <th></th>
              </tr>
              </tfoot>
            </table>
          </div>        
        </div>
        <!-- /.card-body -->
      </div>
</div>
