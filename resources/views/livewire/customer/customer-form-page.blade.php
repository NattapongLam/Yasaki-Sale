<div><br>
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">สร้างลูกค้า</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.pervent="save">
          <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="customer_code">รหัสลูกค้า</label>
                        <input type="text" class="form-control @error('customer_code') is-invalid @enderror" id="customer_code" name="customer_code" placeholder="รหัสลูกค้า" wire:model="customer_code" readonly>
                        @error('customer_code')
                        <div id="customer_code_validation" class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="customer_name">ชื่อลูกค้า</label>
                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" placeholder="ชื่อลูกค้า" wire:model="customer_name">
                        @error('customer_name')
                        <div id="customer_name_validation" class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="sale_code">รหัสพนักงานขาย</label>
                        <input type="text" class="form-control @error('sale_code') is-invalid @enderror" id="sale_code" name="sale_code" placeholder="รหัสพนักงานขาย" wire:model="sale_code">
                        @error('sale_code')
                        <div id="sale_code_validation" class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="customer_flag">สถานะ</label>
                        <select class="form-control @error('customer_flag') is-invalid @enderror" wire:model="customer_flag">
                            <option value="1">ใช้งาน</option>
                            <option value="0">ไม่ใช้งาน</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="custgroup_id">กลุ่มลูกค้า</label>
                        <select class="form-control @error('custgroup_id') is-invalid @enderror" wire:model="custgroup_id" readonly>
                        <option value="">กรุณาเลือก</option>
                           @foreach ($custgp as $custgp)
                               <option value="{{$custgp->id}}">{{$custgp->custgroup_name}}</option>
                           @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="customer_address">ที่อยู่</label>
                        <input type="text" class="form-control @error('customer_address') is-invalid @enderror" id="customer_address" name="customer_address" placeholder="ที่อยู่" wire:model="customer_address" readonly>
                        @error('customer_address')
                        <div id="customer_address_validation" class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="province_id">จังหวัด</label>
                    <select class="form-control @error('province_id') is-invalid @enderror" wire:model="province_id" readonly>
                    <option value="">กรุณาเลือก</option>
                       @foreach ($prov as $prov)
                           <option value="{{$prov->id}}">{{$prov->prov_name}}</option>
                       @endforeach
                    </select>
                </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="district_id">เขต/อำเภอ</label>
                        <select class="form-control @error('district_id') is-invalid @enderror" wire:model="district_id" readonly>
                        <option value="">กรุณาเลือก</option>   
                        @foreach ($dist as $dist)
                        <option value="{{$dist->id}}">{{$dist->dist_name}}</option>
                        @endforeach                   
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="subdistrict_id">แขวง/ตำบล</label>
                        <select class="form-control @error('subdistrict_id') is-invalid @enderror" wire:model="subdistrict_id" readonly>
                        <option value="">กรุณาเลือก</option> 
                        @foreach ($sbdi as $sbdi)
                        <option value="{{$sbdi->id}}">{{$sbdi->subd_name}}</option>
                        @endforeach                      
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="customer_zipcode">รหัสไปรษณีย์</label>
                        <input type="text" class="form-control @error('customer_zipcode') is-invalid @enderror" id="customer_zipcode" name="customer_zipcode" placeholder="รหัสไปรษณีย์" wire:model="customer_zipcode" readonly>
                        @error('customer_zipcode')
                        <div id="customer_zipcode_validation" class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                
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
