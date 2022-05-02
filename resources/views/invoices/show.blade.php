@extends('layouts.master')
@section('title')
    تفاصيل فاتورة
@stop
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">


                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الفاتورة</span>
            </div>
        </div>
    </div>
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات
                                                    الفاتورة</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">


                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">رقم الفاتورة</th>
                                                        <td>{{ $invoice->number }}</td>
                                                        <th scope="row">تاريخ الاصدار</th>
                                                        <td>{{ $invoice->date }}</td>
                                                        <th scope="row">تاريخ الاستحقاق</th>
                                                        <td>{{ $invoice->due_date }}</td>
                                                        <th scope="row">القسم</th>
                                                        <td>{{ $invoice->section->name }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">المنتج</th>
                                                        <td>{{ $invoice->product->name }}</td>
                                                        <th scope="row">مبلغ التحصيل</th>
                                                        <td>{{ $invoice->amount_collection }}</td>
                                                        <th scope="row">مبلغ العمولة</th>
                                                        <td>{{ $invoice->amount_commission }}</td>
                                                        <th scope="row">الخصم</th>
                                                        <td>{{ $invoice->discount }}</td>
                                                    </tr>


                                                    <tr>
                                                        <th scope="row">نسبة الضريبة</th>
                                                        <td>{{ $invoice->rate_vat }}</td>
                                                        <th scope="row">قيمة الضريبة</th>
                                                        <td>{{ $invoice->value_vat }}</td>
                                                        <th scope="row">الاجمالي مع الضريبة</th>
                                                        <td>{{ $invoice->total }}</td>
                                                        <th scope="row">الحالة الحالية</th>
                                                        <td>   @foreach(config('invoice-system.invoice_type') as $type)
                                                                @if($type['id'] == $invoice->type)
                                                                    <span
                                                                        class="{{$type['class']}}">{{$type['name']}}</span>
                                                                @endif
                                                            @endforeach</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">ملاحظات</th>
                                                        <td>{{ $invoice->note }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                       style="text-align:center">
                                                    <thead>
                                                    <tr class="text-dark">
                                                        <th>رقم الفاتورة</th>
                                                        <th>نوع المنتج</th>
                                                        <th>القسم</th>
                                                        <th>حالة الدفع</th>
                                                        <th>تاريخ الدفع</th>
                                                        <th>ملاحظات</th>
                                                        <th>تاريخ الاضافة</th>
                                                        <th>المستخدم</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>{{ $invoice->number }}</td>
                                                        <td>{{ $invoice->product->name }}</td>
                                                        <td>{{ $invoice->Section->name }}</td>
                                                        <td>
                                                            @foreach(config('invoice-system.invoice_type') as $type)
                                                                @if($type['id'] == $invoice->type)
                                                                    <span
                                                                        class="{{$type['class']}}">{{$type['name']}}</span>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $invoice->payment_date }}</td>
                                                        <td>{{ $invoice->note }}</td>
                                                        <td>{{ $invoice->created_at }}</td>
                                                        <td>{{ $invoice->user }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                                <br>
                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                           style="text-align:center">
                                                        <thead>
                                                        <tr class="text-dark">
                                                            <th scope="col">المرفق</th>
                                                            <th scope="col">قام بالاضافة</th>
                                                            <th scope="col">تاريخ الاضافة</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <figure><img src="{{ $invoice->image}}"
                                                                             style="height: 200px;width: 400px;">
                                                                </figure>
                                                            </td>
                                                            <td>{{$invoice->user }}</td>
                                                            <td>{{ $invoice->created_at }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /div -->
        </div>
    </div>
    <!-- /row -->
@endsection
