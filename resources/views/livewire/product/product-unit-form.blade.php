<div>
    <div class="modal fade" id="modal" wire:ignore.self>
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">หน่วยนับ</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="save">
                <div class="form-group">
                    <label for="pdui_code">รหัสหน่วยนับ</label>
                    <input type="text" class="form-control @error('pdui_code') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="pdui_code">
                    @error('pdui_code')
                    <div id="pdui_code_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pdui_name">ชื่อหน่วยนับ</label>
                    <input type="text" class="form-control @error('pdui_name') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="pdui_name">
                    @error('pdui_name')
                    <div id="pdui_name_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pdui_flag">สถานะ</label>
                    <select class="form-control @error('pdui_flag') is-invalid @enderror" wire:model="pdui_flag">
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
