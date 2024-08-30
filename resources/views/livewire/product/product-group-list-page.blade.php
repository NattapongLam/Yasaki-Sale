<div><br>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    @livewire('product.product-group-form')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" wire:click="$emit('createProductGroup')"><i class="fas fa-plus"></i> เพิ่มข้อมูล</button>
                </div>
                <div class="col-sm-6">
                    <p class="float-sm-right">จัดการสินค้า/กลุ่มสินค้า</p>
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
                <th>รหัสกลุ่มสินค้า</th>
                <th>ชื่อกลุ่มสินค้า</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($pdgb as $pdgb)
                      <tr>
                          <td>
                            @if ($pdgb->pdgp_flag)
                            <span class="badge bg-success">ใช้งาน</span>
                            @else
                            <span class="badge bg-danger">ไม่ใช้งาน</span>
                            @endif
                          </td>
                          <td>{{$pdgb->pdgp_code}}</td>
                          <td>{{$pdgb->pdgp_name}}</td>
                          <td class="text-center">
                              <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal" wire:click="$emit('editProductGroup',{{$pdgb->id}})"><i class="fas fa-edit"></i></button>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>สถานะ</th>
                <th>รหัสกลุ่มสินค้า</th>
                <th>ชื่อกลุ่มสินค้า</th>
                <th></th>
              </tr>
              </tfoot>
            </table>
          </div>        
        </div>
        <!-- /.card-body -->
      </div>
</div>
