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
                <h3 class="card-title" style="font-weight: bold">การส่งสินค้าย้อนหลัง 30 วัน</h3><br><hr>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>ลูกค้า</th>
                                <th>สินค้า</th>
                                <th>จำนวนส่ง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hd as $item)
                                <tr>
                                    <td>{{$item->trahd_date}}</td>
                                    <td>{{$item->arname}}</td>
                                    <td>{{$item->itemname}}</td>
                                    <td>{{number_format($item->qty,2)}}</td>
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
</script>
@endpush