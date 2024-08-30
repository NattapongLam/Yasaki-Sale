<div>
    <div class="modal fade" id="modal" wire:ignore.self>
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">แผนก</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="save">
                <div class="form-group">
                    <label for="depa_code">รหัสแผนก</label>
                    <input type="text" class="form-control @error('depa_code') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="depa_code">
                    @error('depa_code')
                    <div id="depa_code_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="depa_name">ชื่อแผนก</label>
                    <input type="text" class="form-control @error('depa_name') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="depa_name">
                    @error('depa_name')
                    <div id="depa_name_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="depa_flag">สถานะ</label>
                    <select class="form-control @error('depa_flag') is-invalid @enderror" wire:model="depa_flag">
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
