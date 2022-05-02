@extends('layouts.master')

@section('title')
    تقرير الفواتير - للادارة الفواتير
@stop
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقرير
                الفواتير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">

                    <form action="{{route('reports.search')}}" method="POST" role="search" autocomplete="off">
                        @csrf
                        <div class="row">

                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">تحديد نوع الفواتير</p><select class="form-control select2"
                                                                                 name="type" required>
                                    <option value=" {{'حدد نوع الفاتورة'}}" selected>
                                        {{'حدد نوع الفاتورة'}}
                                    </option>

                                    <option value="1">الفواتير المدفوعة</option>
                                    <option value="2">الفواتير الغير مدفوعة</option>
                                    <option value="3">الفواتير المدفوعة جزئيا</option>

                                </select>
                            </div><!-- col-4 -->


                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoice_number">
                                <p class="mg-b-10">البحث برقم الفاتورة</p>
                                <input type="text" class="form-control" id="invoice_number" name="invoice_number">

                            </div><!-- col-4 -->

                            <div class="col-lg-3" id="start_at">
                                <label for="exampleFormControlSelect1">من تاريخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                           name="start_at" placeholder="YYYY-MM-DD" type="date">
                                </div><!-- input-group -->
                            </div>

                            <div class="col-lg-3" id="end_at">
                                <label for="exampleFormControlSelect1">الي تاريخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <input class="form-control fc-datepicker" name="end_at"
                                           value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="date">
                                </div><!-- input-group -->
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-2 col-md-2">
                                <button class="btn btn-primary btn-block">بحث</button>
                            </div>
                        </div>
                    </form>

                </div>

                @isset($invoices)
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
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
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
