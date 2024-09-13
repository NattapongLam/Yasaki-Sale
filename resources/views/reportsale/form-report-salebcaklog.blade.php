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
                <h3 class="card-title" style="font-weight: bold">ค้างส่งสินค้า</h3><br><hr>
                <div class="table-responsive">
                    <table id="tb_job" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ลูกค้า</th>
                                <th>สินค้า</th>
                                <th>สต็อค</th>
                                <th>จำนวนค้าง</th>
                                <th>ยอดค้าง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hd as $item)
                                <tr>
                                    <td>{{$item->ARNAME}}</td>
                                    <td>{{$item->ITEMCODE}}/{{$item->ITEMNAME}}</td>
                                    <td>{{number_format($item->pd_stc,2)}}</td>
                                    <td>{{number_format($item->REMAINQTY,2)}}</td>
                                    <td>{{number_format($item->NETAMOUNT,2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">รวม</th>
                                <th>{{number_format($sum)}}</th>
                            </tr>
                        </tfoot>
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
$(document).ready(function() {
        $('#tb_job').DataTable({
            "pageLength": 20,
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
                [4, "desc"]
            ],
        })
    });
</script>
@endpush