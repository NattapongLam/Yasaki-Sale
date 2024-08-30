<div>
    <div class="modal fade" id="modal" wire:ignore.self>
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">เขต/อำเภอ</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form wire:submit.prevent="save">
                <div class="form-group">
                    <label for="prov_id">จังหวัด</label>
                    <select class="form-control @error('prov_id') is-invalid @enderror" wire:model="prov_id">
                        <option value="0">กรุณาเลือก</option>
                        @foreach ($prov as $prov)
                            <option value="{{$prov->id}}">{{$prov->prov_name}}</option>
                        @endforeach
                    </select>
                    @error('prov_id')
                    <div id="prov_id_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="dist_name">ชื่อเขต/อำเภอ</label>
                    <input type="text" class="form-control @error('dist_name') is-invalid @enderror" placeholder="ระบุข้อมูล" wire:model="dist_name">
                    @error('dist_name')
                    <div id="dist_name_validation" class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>               
                <div class="form-group">
                    <label for="dist_flag">สถานะ</label>
                    <select class="form-control @error('dist_flag') is-invalid @enderror" wire:model="dist_flag">
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
