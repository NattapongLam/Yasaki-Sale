<div><br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    @livewire('customer.customer-group-form')
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" wire:click="$emit('createCustomerGroup')"><i class="fas fa-plus"></i> เพิ่มข้อมูล</button> --}}
                </div>
                <div class="col-sm-6">
                    <p class="float-sm-right">จัดการลูกค้า/กลุ่มลูกค้า</p>
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
                <th>กลุ่มลูกค้า</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($custgp as $custgp)
                      <tr>
                          <td>
                            @if ($custgp->custgroup_flag)
                            <span class="badge bg-success">ใช้งาน</span>
                            @else
                            <span class="badge bg-danger">ไม่ใช้งาน</span>
                            @endif
                          </td>
                          <td>{{$custgp->custgroup_code}}/{{$custgp->custgroup_name}}</td>
                          <td class="text-center">
                              <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal" wire:click="$emit('editCustomerGroup',{{$custgp->id}})"><i class="fas fa-edit"></i></button>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>สถานะ</th>
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
