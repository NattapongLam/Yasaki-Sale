@extends('layouts.main')
@section('content')
<div class="mt-4"><br>
<div class="row">   
    <div class="col-12">
        <div class="card">
            @if(session('success'))
            <div class="alert" role="alert">
                <button type="button" class="btn btn-outline-success btn-sm btn-block">{{ session('success') }}</button>
            </div>
            @elseif(session('error'))
            <div class="alert" role="alert">
                <button type="button" class="btn btn-outline-danger btn-sm btn-block">{{ session('error') }}</button>
            </div>
            @endif
            <div class="card-body">                   
                    <form method="GET" action="{{ route('requestorder.index') }}" class="row">
                        <div class="col-5">
                            <label>วันที่</label>
                            <input type="date" class="form-control" name="start_date" value="{{ $start_date }}">
                        </div>
                        <div class="col-5">
                            <label>ถึง</label>
                            <input type="date" class="form-control" name="end_date" value="{{ $end_date }}">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary" style="margin-top: 32px;">ค้นหา</button>
                        </div>
                    </form><br>
                    <div class="row">
                        <h3 class="card-title" style="font-weight: bold">รายการใบสั่งจอง</h3>
                    </div>
                <div style="overflow-x:auto;">
                    <table id="tb_job" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">วันที่</th>
                                <th class="text-center">สถานะ</th>                               
                                <th class="text-center">เลขที่</th>                               
                                <th class="text-center">ลูกค้า</th>
                                <th class="text-center">พนักงาน</th>
                                <th class="text-center">วันที่ต้องการส่ง</th>
                                <th class="text-center">ใบจองสินค้า</th>
                                <th class="text-center">บิลขาย</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hd as $item)
                                <tr>
                                    <td class="text-center">{{\Carbon\Carbon::parse($item->requestorder_hd_date)->format('d/m/Y')}}</td>
                                    <td class="text-center">
                                        @if($item->requestorder_status_id == 1)
                                        <span class="badge bg-warning">{{$item->requestorder_status_name}}</span>
                                        @elseif($item->requestorder_status_id == 2 )
                                        <span class="badge bg-danger">{{$item->requestorder_status_name}}</span>
                                        @elseif($item->requestorder_status_id == 3 )
                                        <span class="badge bg-info">{{$item->requestorder_status_name}}</span>
                                        @elseif($item->requestorder_status_id == 4 )
                                        <span class="badge bg-success">{{$item->requestorder_status_name}}</span>
                                        @elseif($item->requestorder_status_id == 5 )
                                        <span class="badge bg-primary">{{$item->requestorder_status_name}}</span>
                                        @endif
                                    </td>                                
                                    <td class="text-center">{{$item->requestorder_hd_docuno}}</td>                                   
                                    <td class="text-center">{{$item->customer_name}}</td>
                                    <td class="text-center">{{$item->sa_name}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($item->requestorder_hd_duedate)->format('d/m/Y')}}</td>
                                    <td class="text-center">{{$item->salerequest_docuno}}</td>
                                    <td class="text-center">{{$item->saleorder_docuno}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('requestorder.show',$item->requestorder_hd_id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>เอกสาร</a>
                                    </td>
                                    <td class="text-center">
                                        @if($item->requestorder_status_id == 1)
                                        <a href="{{ route('requestorder.edit',$item->requestorder_hd_id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" onclick="onDelete('{{$item->requestorder_hd_id}}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        @elseif($item->requestorder_status_id == 3)
                                        <a href="{{ route('requestorder.edit',$item->requestorder_hd_id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>แก้ไข</a>
                                        @endif       
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scriptjs')
<script>
setTimeout(() => {
    $('.alert').alert('close');
}, 1500);
onDelete = (id) => {
        // confirm
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่ !',
            text: `คุณต้องการปิดเอกสารนี้หรือไม่ ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then(function(result) {
            if (result.value) {

                $.ajax({
                    url: "{{ url('/cancelDoc') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        refid: id
                    },
                    dataType: "json",
                    success: function(data) {

                        if (data.status == true) {
                            Swal.fire({
                                title: 'สำเร็จ',
                                text: 'ปิดเอกสารเรียบร้อยแล้ว',
                                icon: 'success'
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'ไม่สำเร็จ',
                                text: 'ปิดเอกสารไม่สำเร็จ',
                                icon: 'error'
                            });
                        }

                    }
                });
            }

        });
}
$(document).ready(function() {
        $('#tb_job').DataTable({
            "pageLength": 50,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            //order by
            "order": [
                [2, "desc"]
            ],
        })
    });   
</script>
@endpush