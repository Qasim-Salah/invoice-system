@extends('layouts.master')

@section('title')
    تعديل فاتورة
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
    @include('layouts.includes.alerts.success')
    @include('layouts.includes.alerts.errors')
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.update',$invoice->id) }}" method="POST" enctype="multipart/form-data"
                          autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="inputName" class="control-label">رقم الفاتورة</label>
                                    <input type="text" class="form-control" id="inputName" value="{{old('number',$invoice->number)}}"
                                           name="number"
                                           title="يرجي ادخال رقم الفاتورة" required>
                                    @error('number')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label>تاريخ الاستحقاق</label>
                                    <input class="form-control fc-datepicker" value="{{old('due_date',$invoice->due_date)}}" name="due_date"
                                           placeholder="YYYY-MM-DD"
                                           type="date" required>
                                    @error('due_date')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- 2 --}}
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mb-5">
                                    <label for="inputName" class="control-label  ">القسم</label>
                                    <select name="section_id" class="form-control changeSection SlectBox" id="section">
                                        <!--placeholder-->
                                        @foreach ($sections as $section)
                                            <option
                                                value="{{ $section->id }}" {{ (old('section_id',$invoice->section_id) == $invoice->section_id ? 'selected':'') }}>{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="inputName" class="control-label">المنتج</label>
                                    <select name="product_id" class="form-control" id="product">
                                        <option selected disabled>حدد المنتج</option>
                                        @if(old('product_id',$invoice->product_id) || old('section_id',$invoice->section_id))
                                            @foreach(product(old('section_id',$invoice->section_id)) as $value)
                                                <option
                                                    value="{{$value->id}}" {{ (old('product_id',$invoice->product_id) == $value->id ? 'selected':'') }}>{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('product_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                    <input type="text" class="form-control" value="{{old('amount_collection',$invoice->amount_collection)}}"
                                           max="" id="inputName" name="amount_collection">
                                    @error('amount_collection')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- 3 --}}
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="inputName" class="control-label">مبلغ العمولة</label>
                                    <input type="text" class="form-control form-control-lg"
                                           value="{{old('amount_commission',$invoice->amount_commission)}}" id="amount_commission"
                                           name="amount_commission" title="يرجي ادخال مبلغ العمولة "
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                           required>
                                    @error('amount_commission')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="inputName" class="control-label">الخصم</label>
                                    <input type="text" value="{{old('discount',$invoice->discount)}}" class="form-control form-control-lg"
                                           id="discount" name="discount"
                                           title="يرجي ادخال مبلغ الخصم "
                                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                    @error('discount')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                    <select name="rate_vat" id="rate_vat" class="form-control" onchange="myFunction()">
                                        <!--placeholder-->
                                        <option value="{{$invoice->rate_vat}}" selected disabled>{{$invoice->rate_vat}}%</option>
                                        <option value="5" {{(old('rate_vat',$invoice->rate_vat) == 5 ? 'selected' : '')}}>5%</option>
                                        <option value="10"{{(old('rate_vat',$invoice->rate_vat) == 10 ? 'selected' : '')}}>10%</option>
                                    </select>
                                    @error('rate_vat')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- 4 --}}
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                    <input type="text" value="{{old('value_vat',$invoice->value_vat)}}" class="form-control" id="value_vat"
                                           name="value_vat" readonly>
                                    @error('value_vat')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" value="{{old('total',$invoice->total)}}" class="form-control" id="total" name="total"
                                       readonly>
                                @error('total')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- 5 --}}
                        <div class="form-group mb-3">
                            <div class="col-lg-12">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note">{{old('note',$invoice->note)}}</textarea>
                                @error('note')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-lg-12">
                            <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                            <h5 class="card-title">المرفقات</h5>

                            <div class="form-group mb-3">
                                <input type="file" name="image" value="{{old('image',$invoice->image)}}" class="dropify"
                                       accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                       data-height="70"/>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                            <button type="submit" class="btn btn-primary">تحديث البيانات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>

        $('.changeSection').on('change', function () {
            var section = $('#section').val();
            $('#product').empty();
            if (section) {
                $.ajax({
                    url: "{{url('api/v1/sections')}}" + "/" + section,
                    type: "GET",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('#product').append(' <option selected disabled >حدد المنتج</option>');
                        $.map(data, function (value) {
                            $('#product').append('<option value="' + value.id + '">' + value.name + '</option>');

                        });
                    }
                });
            }
        });

        function myFunction() {

            var amount_commission = document.getElementById("amount_commission").value
            var discount = document.getElementById("discount").value
            var rate_vat = document.getElementById("rate_vat").value
            var value_vat = document.getElementById("value_vat").value

            var Amount_Commission2 = amount_commission - discount;


            if (typeof amount_commission === 'undefined' || !amount_commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * rate_vat / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("value_vat").value = sumq;

                document.getElementById("total").value = sumt;

            }

        }


    </script>

@endsection
