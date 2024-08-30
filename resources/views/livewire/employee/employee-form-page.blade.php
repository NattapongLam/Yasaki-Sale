<div><br>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">สร้างผู้ใช้งาน</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.pervent="save">
          <div class="card-body">
            <div class="form-group">
              <label for="name">ชื่อ - นามสกุล</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="ชื่อ - นามสกุล" wire:model="name">
              @error('name')
              <div id="name_validation" class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="ชื่อผู้ใช้" wire:model="username">
                @error('username')
                <div id="username_validation" class="invalid-feedback">{{$message}}</div>
                @enderror
              </div>
            <div class="form-group">
              <label for="password">รหัสผ่าน</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="รหัสผ่าน" wire:model="password">
              @error('password')
                <div id="password_validation" class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group">
                <label for="email">อีเมล</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล" wire:model="email">
            </div>
            <div class="form-group">
                <label for="phone">เบอร์โทร</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="เบอร์โทร" wire:model="phone">
            </div>
            <div class="form-group">
              <label for="status">สถานะ</label>
              <select class="form-control @error('status') is-invalid @enderror" wire:model="status">
                  <option value="1">ใช้งาน</option>
                  <option value="0">ไม่ใช้งาน</option>
              </select>
          </div>
          </div>
          <!-- /.card-body -->
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
