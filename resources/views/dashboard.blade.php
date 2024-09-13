
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.header')
  <!-- /.navbar -->
  @include('layouts.sidebar')
  <!-- Main Sidebar Container -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"><br>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">   
            <h3 style="text-align: center">นโยบายคุณภาพ</h3>                                    
            <h5 style="text-align: center">ผลิตสินค้าที่มีคุณภาพ ได้มาตรฐาน บริหารต้นทุนอย่างมีประสิทธิภาพ ส่งมอบสินค้าถูกต้อง ทันเวลา พัฒนาต่อเนื่อง เพื่อความพึงพอใจของลูกค้า</h5>  
            <hr>
            <div class="row">
              <div class="col-md-4 col-sm-6 col-12">
                <a href="{{route('requestorder.create')}}" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                      ใบสั่งซื้อ
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
              <div class="col-md-4 col-sm-6 col-12">
                <a href="{{route('requestorder.index')}}" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                      รายการสั่งซื้อ
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
              <div class="col-md-4 col-sm-6 col-12">
                <a href="{{route('stockcard.index')}}" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                      สต็อคสินค้า
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
            </div>  
            <div class="row">
              <div class="col-md-4 col-sm-6 col-12">
                <a href="{{ url('/requestorder-list') }}" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                     ยอดจองสินค้า
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
              <div class="col-md-4 col-sm-6 col-12">
                <a href="{{ url('/report-sendproduct') }}" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                      ยอดส่งของลูกค้า
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
              <div class="col-md-4 col-sm-6 col-12">
                <a href="{{ url('/report-billorder') }}" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                      เปิดบิลลูกค้า
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
            </div> 
            <div class="row">
              <div class="col-md-4 col-sm-6 col-12">
                <a href="{{ url('/report-grouplow') }}" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-danger"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                    กลุ่มสินค้ายอดผิดปกติ
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
              <div class="col-md-4 col-sm-6 col-12">
                <a href="{{ url('/report-backlog') }}" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-danger"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                      ค้างส่งของลูกค้า
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
              <div class="col-md-4 col-sm-6 col-12">
                <a href="{{ url('/report-saleorder') }}" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-danger"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                      ภาพรวมยอดขาย
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-sm-6 col-12">
                <a href="{{ url('/report-saleordermonth') }}" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                    ยอดขายประจำเดือน
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
              <div class="col-md-4 col-sm-6 col-12">
                <a href="https://demo.revoteq-yasaki.com/isosals" class="nav-link">
                <div class="info-box">
                  <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                  <div class="info-box-content">
                    <h4>
                     เอกสาร ISO
                    </h4>                 
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </a>
              </div>
            </div>
          </div>
        </div>    
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('layouts.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
@livewireScripts
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "excel","colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  window.addEventListener('swal',function(e){
    Swal.fire({
      title: e.detail.title,
      timer: e.detail.timer,
      icon: e.detail.icon
    }).then(function(){
      if(e.detail.url){
        window.location = e.detail.url;
      }
    })
  });
  window.livewire.on("modalHide",() => {
    $("#modal").modal("hide");
  })
</script>
</body>
</html>
