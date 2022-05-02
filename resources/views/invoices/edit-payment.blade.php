@extends('layouts.master')

@section('title')
    تعديل حالة الفاتورة
@stop

@section('content')

    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل فاتورة</span>
            </div>
        </div>
    </div>

    <!-- row -->
    @include('layouts.includes.alerts.success')
    @include('layouts.includes.alerts.errors')
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('invoices.update.payment',$invoice->id) }}" method="POST"
                          enctype="multipart/form-data"
                          autocomplete="off">
                        @csrf
                        @isset($invoice)
                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">رقم الفاتورة</label>
                                    <input type="text" class="form-control" id="inputName" name="invoice_number"
                                           readonly
                                           value="{{$invoice->number}}" title="يرجي ادخال رقم الفاتورة" required>
                                </div>

                                <div class="col">
                                    <label>تاريخ الفاتورة</label>
                                    <input class="form-control fc-datepicker" name="invoice_date"
                                           placeholder="YYYY-MM-DD"
                                           readonly type="text" value="{{$invoice->date}}" required>
                                </div>

                                <div class="col">
                                    <label>تاريخ الاستحقاق</label>
                                    <input class="form-control fc-datepicker" name="due_date" readonly
                                           value="{{$invoice->due_date}}"
                                           placeholder="YYYY-MM-DD"
                                           type="date" required>
                                </div>

                            </div>

                            {{-- 2 --}}
                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">القسم</label>
                                    <select name="section_id" class="form-control SlectBox" readonly>
                                        <!--placeholder-->
                                        @foreach ($sections as $section)
                                            <option
                                                value="{{ $section->id }}" {{ (old('section_id',$invoice->section_id) == $invoice->section_id ? 'selected':'') }}>{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">المنتج</label>
                                    <select name="product_id" class="form-control" readonly>
                                        <option selected disabled>حدد المنتج</option>
                                        @if(old('product_id',$invoice->product_id) || old('section_id',$invoice->section_id))
                                            @foreach(product(old('section_id',$invoice->section_id)) as $value)
                                                <option
                                                    value="{{$value->id}}" {{ (old('product_id',$invoice->product_id) == $value->id ? 'selected':'') }}>{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                    <input type="text" class="form-control" id="inputName" readonly
                                           value="{{$invoice->amount_collection}}"
                                           name="amount_collection"
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                            </div>


                            {{-- 3 --}}

                            <div class="row">

                                <div class="col">
                                    <label for="inputName" class="control-label">مبلغ العمولة</label>
                                    <input type="text" class="form-control form-control-lg" id="amount_commission"
                                           value="{{$invoice->amount_commission}}" name="amount_commission"
                                           title="يرجي ادخال مبلغ العمولة "
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                           required>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">الخصم</label>
                                    <input type="text" class="form-control form-control-lg" id="discount" readonly
                                           value="{{$invoice->discount}}"
                                           name="discount"
                                           title="يرجي ادخال مبلغ الخصم "
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                           required>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة </label>
                                    <select name="rate_vat" id="rate_vat" class="form-control" readonly
                                            onchange="myFunction()">
                                        <!--placeholder-->
                                        <option value="{{$invoice->rate_vat}}" selected
                                                disabled>{{$invoice->rate_vat}}%
                                        </option>
                                    </select>
                                </div>

                            </div>

                            {{-- 4 --}}

                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                    <input type="text" value="{{$invoice->value_vat}}" class="form-control"
                                           id="value_vat" name="value_vat"
                                           readonly>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                    <input type="text" value="{{$invoice->total}}" class="form-control" id="total"
                                           name="total" readonly>
                                </div>
                            </div>

                            {{-- 5 --}}
                            <div class="row">
                                <div class="col">
                                    <label for="exampleTextarea">ملاحظات</label>
                                    <textarea readonly class="form-control" id="exampleTextarea" name="note"
                                              rows="3">{{$invoice->note}}</textarea>
                                </div>
                            </div>
                            <br>
                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                            <h5 class="card-title">المرفقات</h5>

                            <div class="col-sm-12 col-md-12">
                                <input type="file" name="image" value="{{$invoice->image}}" readonly
                                       accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                       data-height="70"/>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col">
                                    <label for="exampleTextarea">حالة الدفع</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option selected="true" disabled="disabled">-- حدد حالة الدفع --</option>
                                        <option value="{{App\Enums\InvoiceType::Driven->value}}">مدفوعة</option>
                                        <option value="{{App\Enums\InvoiceType::Unpaid->value}}">غير مدفوعة</option>
                                        <option value="{{App\Enums\InvoiceType::Partially->value}}">مدفوعة جزئيا
                                        </option>
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label>تاريخ الدفع</label>
                                    <input class="form-control fc-datepicker" name="payment_date"
                                           placeholder="YYYY-MM-DD"
                                           type="date" required>
                                    @error('payment_date')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
                            </div>
                    </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
