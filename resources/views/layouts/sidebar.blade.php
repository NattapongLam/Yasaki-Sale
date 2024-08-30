<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('assets/dist/img/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      @auth
      <span class="brand-text font-weight-light">{{auth()->user()->name}}</span>    
      @endauth     
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div> --}}
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">    
        @role('superadmin')    
        <li class="nav-header">ตั้งค่า</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>
                        จัดการระบบ
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('employee.list')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>ผู้ใช้งาน</p>
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('department.list')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>แผนก</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('person.list')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>พนักงาน</p>
                      </a>
                    </li>
                </ul>
            </li>
          @endrole
          @role('superadmin|admin') 
            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tags"></i>
                  <p>
                      จัดการทั่วไป
                  <i class="fas fa-angle-left right"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('province.list')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>จังหวัด</p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('district.list')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>เขต/อำเภอ</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('subdistrict.list')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>แขวง/ตำบล</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('typevat.list')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>ประเภทภาษี</p>
                    </a>
                  </li>
              </ul>
            </li> --}}
            <li class="nav-item">
              <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tags"></i>
                  <p>
                      จัดการลูกค้า
                  <i class="fas fa-angle-left right"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('customergroup.list')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>กลุ่มลูกค้า</p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('customer.list')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>ลูกค้า</p>
                    </a>
                </li>
              </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                    จัดการสินค้า
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('productgroup.list')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>กลุ่มสินค้า</p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('productunit.list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>หน่วยนับ</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('product.list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>สินค้า</p>
                  </a>
                </li>
            </ul>
        </li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                  จัดการคลังสินค้า
              <i class="fas fa-angle-left right"></i>
              </p>
          </a>
          <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>คลังสินค้า</p>
                  </a>
              </li>
          </ul>
      </li> --}}
    @endrole
        <li class="nav-header">เอกสาร</li>
            <li class="nav-item">
                <a href="{{route('requestorder.create')}}" class="nav-link">
                    <i class="nav-icon far fa-edit"></i>
                    <p>สร้างใบสั่งจอง</p>
                </a>
            </li>
            <li class="nav-item">
              <a href="{{route('requestorder.index')}}" class="nav-link">
                  <i class="nav-icon far fa-edit"></i>
                  <p>รายการสั่งจอง</p>
              </a>
          </li>
        <li class="nav-header">รายงาน</li>
        <li class="nav-item">
          <a href="{{route('stockcard.index')}}" class="nav-link">
              <i class="nav-icon fas fa-paste"></i>
              <p>รายงานสินค้า</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/requestorder-list') }}" class="nav-link">
              <i class="nav-icon fas fa-paste"></i>
              <p>รายงานยอดจองสินค้า</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/report-sendproduct') }}" class="nav-link">
              <i class="nav-icon fas fa-paste"></i>
              <p>รายงานส่งสินค้า</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/report-billorder') }}" class="nav-link">
              <i class="nav-icon fas fa-paste"></i>
              <p>รายงานเปิดบิลลูกค้า</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/report-grouplow') }}" class="nav-link">
                <i class="nav-icon fas fa-paste"></i>
                <p>รายงานกลุ่มสินค้าผิดปกติ</p>
            </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/report-backlog') }}" class="nav-link">
              <i class="nav-icon fas fa-paste"></i>
              <p>รายงานค้างส่งสินค้า</p>
          </a>
        </li> 
        <li class="nav-item">
          <a href="{{ url('/report-saleorder') }}" class="nav-link">
              <i class="nav-icon fas fa-paste"></i>
              <p>รายงานยอดขาย</p>
          </a>
        </li>       
        <li class="nav-header">Exit</li>
        <li class="nav-item">
          <a href="javascript:void();" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-power-off"></i>
            <p>ออกจากระบบ</p>           
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->   
    </div>
    <!-- /.sidebar -->
  </aside>