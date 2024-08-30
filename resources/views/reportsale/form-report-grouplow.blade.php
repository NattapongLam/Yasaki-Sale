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
                <h3 class="card-title" style="font-weight: bold">กลุ่มสินค้าผิดปกติจะแสดงแต่กลุ่มที่ผิดปกตินะครับไม่ผิดปกติจะไม่แสดง</h3><br><hr>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>กลุ่มสินค้า</th>
                                <th>ลูกค้า</th>
                                <th>จังหวัด</th>
                                <th>ยอดขายปีก่อนหน้า(บาท)</th>
                                <th>ยอดขายปีปัจจุบัน(บาท)</th>
                                <th>%(บาท)</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($hd as $item)
                            <tr>
                                <td>{{$item->productgroup}}</td>
                                <td>{{$item->customername}}</td>
                                <td>{{$item->provincename}}</td>
                                <td>{{number_format($item->amountold,2)}}</td>
                                <td>{{number_format($item->amountnew,2)}}</td>
                                <td>{{number_format($item->amountper,2)}}</td>
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