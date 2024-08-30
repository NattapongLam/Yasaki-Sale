<div>
    <div class="modal fade" id="modal" wire:ignore.self>
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">กลุ่มสินค้า</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="save">
                <div class="form-group">
                    <label for="pdgp_code">รหัสกลุ่มสินค้า</label>
                    <input type="text" class="form-control @error('pdgp_code') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="pdgp_code">
                    @error('pdgp_code')
                    <div id="pdgp_code_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pdgp_name">ชื่อกลุ่มสินค้า</label>
                    <input type="text" class="form-control @error('pdgp_name') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="pdgp_name">
                    @error('pdgp_name')
                    <div id="pdgp_name_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="prov_flag">สถานะ</label>
                    <select class="form-control @error('prov_flag') is-invalid @enderror" wire:model="prov_flag">
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
