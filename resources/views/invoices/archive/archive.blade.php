@extends('layouts.master')
@section('title')
    قائمة الفواتير المؤرشفة
@stop
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفواتير المؤرشفة</span>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        @include('layouts.includes.alerts.success')
        @include('layouts.includes.alerts.errors')
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">

                    {{--                    @can('تصدير EXCEL')--}}
                    <a class="modal-effect btn btn-sm btn-primary" href="{{ url('export_invoices') }}"
                       style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>
                    {{--                    @endcan--}}

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                               style="text-align: center">
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
                                    <td><{{$invoice->section->name}}</td>
                                    <td>
                                        @foreach(config('invoice-system.invoice_type') as $type)
                                            @if($type['id'] == $invoice->type)
                                                <span class="{{$type['class']}}">{{$type['name']}}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="dropdown" style="height: 80px;">
                                            <button class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i>
                                            </button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item"
                                                   href="{{route('invoices.update.archive',$invoice->id)}}"><i
                                                        class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;
                                                    الالغاء الارشفة </a>
                                                <a class="dropdown-item"
                                                   href="#" id="delete" data-id="{{$invoice->id}}"><i
                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;حذف </a>
                                                <a class="dropdown-item" href="Print_invoice/{{ $invoice->id }}"><i
                                                        class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة الفاتورة</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
                            url: '{{url('/invoices/archive')}}' + "/" + id,
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
