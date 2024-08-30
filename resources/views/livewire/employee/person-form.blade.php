<div>
    <div class="modal fade" id="modal" wire:ignore.self>
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">พนักงาน</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="save">
                <div class="form-group">
                    <label for="emp_code">รหัสพนักงาน</label>
                    <input type="text" class="form-control @error('emp_code') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="emp_code">
                    @error('emp_code')
                    <div id="emp_code_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="emp_name">ชื่อ - นามสกุล</label>
                    <input type="text" class="form-control @error('emp_name') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="emp_name">
                    @error('emp_name')
                    <div id="emp_name_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="depa_code">แผนก</label>
                    <select class="form-control @error('depa_code') is-invalid @enderror" wire:model="depa_code">
                        <option value="">กรุณาเลือก</option>
                    @foreach ($dep as $dep)
                        <option value="{{$dep->depa_code}}">{{$dep->depa_name}}</option>
                    @endforeach
                    </select>
                    @error('depa_code')
                    <div id="depa_code_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="emp_flag">สถานะ</label>
                    <select class="form-control @error('emp_flag') is-invalid @enderror" wire:model="emp_flag">
                        <option value="1">ใช้งาน</option>
                        <option value="0">ไม่ใช้งาน</option>
                    </select>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
              <button type="button" class="btn btn-primary" wire:click="save">บันทึก</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
