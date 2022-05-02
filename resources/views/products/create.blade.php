@extends('layouts.master')
@section('title')
    اضافة المنتجات
@stop

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                 اضافة منتج</span>
            </div>
        </div>
    </div>
    @include('layouts.includes.alerts.success')
    @include('layouts.includes.alerts.errors')
    <div class="row">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافة منتج</h6>
            </div>

            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group mb-3">
                        <label>اسم المنتج</label>
                        <input type="text" class="form-control" value="{{old('name')}}" name="name"
                               placeholder="أضافة منتج">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label class="my-1 mr-2">القسم</label>
                    <select name="section_id" class="form-control mb-3" required>
                        <option selected disabled> --حدد القسم--</option>
                        @foreach ($sections as $section)
                            <option
                                value="{{ $section->id }}" {{ (old('section_id') == $section->id ? 'selected':'') }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                    @error('section_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="form-group mb-3">
                        <label>ملاحظات</label>
                        <textarea class="form-control" name="description"
                                  placeholder="أدخل الملاحضات">{{old('description')}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-main-primary mt-3 mb-5">
                            أضافة
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Basic modal -->

    </div>

@endsection
