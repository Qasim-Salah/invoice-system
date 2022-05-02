@extends('layouts.master')
@section('title')
    الفواتير
@stop
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفواتير</span>
            </div>
        </div>
    </div>
    @include('layouts.includes.alerts.success')
    @include('layouts.includes.alerts.errors')
    <!-- row -->
    <div class="row">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{route('invoices.create')}}" class="modal-effect btn btn-sm btn-primary"
                           style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap text-center" data-page-length='50'>
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="border-bottom-0">رقم الفاتورة</th>
                                <th class="border-bottom-0">تاريخ القاتورة</th>
                                <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                <th class="border-bottom-0">المنتج</th>
                                <th class="border-bottom-0">القسم</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{ $invoice->number }} </td>
                                    <td>{{ $invoice->date }}</td>
                                    <td>{{ $invoice->due_date }}</td>
                                    <td>{{ $invoice->product->name }}</td>
                                    <td><a href="{{route('invoices.show',$invoice->id)}}">
                                            {{$invoice->section->name}}</a>
                                    </td>
                                    <td>
                                        @foreach(config('invoice-system.invoice_type') as $type)
                                            @if($type['id'] == $invoice->type)
                                                <span class="{{$type['class']}}">{{$type['name']}}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="dropdown" style="height: 45px">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn  btn-primary btn-sm dropdown-toggle" id="dropdownMenu"
                                                    data-toggle="dropdown"
                                                    type="button">العمليات</i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                                <a class="dropdown-item"
                                                   href=" {{ route('invoices.edit',$invoice->id) }}"><i
                                                        class="text-danger fas fa-edit"></i>تعديل الفاتورة </a>
                                                <a class="dropdown-item" id="delete" data-id="{{$invoice->id}}"
                                                   href="#"><i
                                                        class="text-danger fas fa-trash-alt"></i>حذف الفاتورة</a>
                                                <a class="dropdown-item"
                                                   href="{{route('invoices.edit.payment',$invoice->id)}}"><i
                                                        class=" text-success fas fa-money-bill"></i>تغير حالة الدفع</a>
                                                <a class="dropdown-item"
                                                   href="{{route('invoices.destroy.archive',$invoice->id)}}"><i
                                                        class="text-warning fas fa-exchange-alt"></i>نقل الي الارشيف</a>
                                                <a class="dropdown-item"
                                                   href="{{route('invoices.print',$invoice->id)}}"><i
                                                        class="text-success fas fa-print"></i>طباعة الفاتورة</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
@endsection
@section('js')
    <script>
        $(document).on('click', '#delete', function () {
            var id = $(this).attr('data-id');
            var token = $('meta[name="csrf-token"]').attr('content')
            var dialog = bootbox.confirm({
                message: "هل انت متأكد من عملية الحذف ؟",
                callback: function (result) {
                    console.log(result);
                    if (result === false) {
                        dialog.modal('hide');
                    } else {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{url('/invoices')}}' + "/" + id,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function () {
                                bootbox.alert({
                                    message: "تم الحذف بنجاح ",
                                    className: 'bb-alternate-modal'
                                });
                                setTimeout(function () {
                                    location.reload();
                                }, 2000)
                            },

                        });
                    }
                }
            });
        });
    </script>
@endsection
