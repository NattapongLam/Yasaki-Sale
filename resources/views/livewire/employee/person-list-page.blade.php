<div><br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    @livewire('employee.person-form')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" wire:click="$emit('createPerson')"><i class="fas fa-plus"></i> เพิ่มข้อมูล</button>
                </div>
                <div class="col-sm-6">
                    <p class="float-sm-right">จัดการระบบ/พนักงาน</p>
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
                <th>รหัสพนักงาน</th>
                <th>ชื่อ - นามสกุล</th>
                <th>แผนก</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($emp as $emp)
                      <tr>
                          <td>
                            @if ($emp->emp_flag)
                            <span class="badge bg-success">ใช้งาน</span>
                            @else
                            <span class="badge bg-danger">ไม่ใช้งาน</span>
                            @endif
                          </td>
                          <td>{{$emp->emp_code}}</td>
                          <td>{{$emp->emp_name}}</td>
                          <td>{{$emp->depa_code}}</td>
                          <td class="text-center">
                              <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal" wire:click="$emit('editPerson',{{$emp->id}})"><i class="fas fa-edit"></i></button>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
              <tr>
                  <th>สถานะ</th>
                  <th>รหัสพนักงาน</th>
                  <th>ชื่อ - นามสกุล</th>
                  <th>แผนก</th>
                <th></th>
              </tr>
              </tfoot>
            </table>
          </div>        
        </div>
        <!-- /.card-body -->
      </div>
</div>
