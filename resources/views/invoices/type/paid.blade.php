@extends('layouts.master')
@section('title')
    الفواتير المدفوعة
@stop
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير
                    المدفوعة
                </span>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{route('invoices.create')}}" class="modal-effect btn btn-sm btn-primary"
                           style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
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
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i>
                                            </button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item"
                                                   href="{{route('invoices.edit',$invoice->id)}}">
                                                    <i class="text-danger fas fa-edit"></i>&nbsp;
                                                    تعديل
                                                    الفاتورة</a>

                                                <a class="dropdown-item"
                                                   href="{{ route('invoices.destroy',$invoice->id) }}">
                                                    <i class="text-danger fas fa-trash-alt"></i>&nbsp;
                                                    حذف الفاتورة</a>

                                                <a class="dropdown-item"
                                                   href="{{route('invoices.edit.payment',$invoice->id)}}"><i
                                                        class=" text-success fas  fa-money-bill"></i>تغير حالة الدفع</a>

                                                <a class="dropdown-item"
                                                   href="{{route('invoices.destroy.archive',$invoice->id)}}"><i
                                                        class="text-warning fas fa-exchange-alt"></i>نقل الي الارشيف</a>

                                                <a class="dropdown-item" href="Print_invoice/{{ $invoice->id }}"><i
                                                        class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                    الفاتورة
                                                </a>
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
    </div>
@endsection

