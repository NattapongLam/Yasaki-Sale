<div>
    <div class="modal fade" id="modal" wire:ignore.self>
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">กลุ่มลูกค้า</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="save">
                <div class="form-group">
                    <label for="custgroup_code">รหัสกลุ่มลูกค้า</label>
                    <input type="text" class="form-control @error('custgroup_code') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="custgroup_code">
                    @error('custgroup_code')
                    <div id="custgroup_code_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="custgroup_name">ชื่อกลุ่มลูกค้า</label>
                    <input type="text" class="form-control @error('custgroup_name') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="custgroup_name">
                    @error('custgroup_name')
                    <div id="custgroup_name_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="custgroup_flag">สถานะ</label>
                    <select class="form-control @error('custgroup_flag') is-invalid @enderror" wire:model="custgroup_flag">
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