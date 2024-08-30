<div><br>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">กำหนดสิทธิ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.pervent="save">
          <div class="card-body">
            <div class="form-group">
              <label for="role" class="col-form-label">ระดับ</label>
              <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" wire:model="role">
              <option value="">กรุณาเลือกระดับ</option>
              @foreach ($roles as $item)
              <option value="{{$item->name}}">                           
                  {{$item->name}}                       
              </option>
              @endforeach
              </select>
            </div>
            {{-- <div class="form-group">
              <label for="permission" class="col-form-label">เมนู</label>
              <div class="row">
                  @foreach ($permissions as $key => $item)
                  <div class="col-2 form-check mb-2">
                      <input class="form-check-input" type="checkbox" wire:model="permission.{{$key}}" id="formCheck1 {{$item->id}}" value="{{$item->name}}">
                      <label class="form-check-label" for="formCheck1 {{$item->id}}">{{$item->name}}</label>
                  </div>                           
              @endforeach 
              </div>                                                     
            </div> --}}
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">บันทึก</button>
          </div>
        </form>
        <div wire:loading wire:target="save" wire:loading.class="overlay" wire:loading.flex>
          <div class="d-flex justify-content-center align-items-center">
              <i class="fas fa-2x fa-sync fa-spin"></i>
          </div>
      </div>
    </div>
</div>