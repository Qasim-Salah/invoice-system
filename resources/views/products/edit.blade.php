@extends('layouts.master')
@section('title')
    تعديل المنتجات
@stop

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                 تعديل منتج</span>
            </div>
        </div>
    </div>
    <div class="row">
        @include('layouts.includes.alerts.success')
        @include('layouts.includes.alerts.errors')
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل المنتجات</h6>
            </div>

            <div class="modal-body">
                <form action="{{ route('products.update',$products->id) }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label>اسم القسم</label>
                        <input type="text" class="form-control" value="{{old('name',$products->name)}}" name="name">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <label class="my-1 mr-2">القسم</label>
                    <select name="section_id" class="form-control" required>
                        <option selected disabled> --حدد القسم--</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" {{ (old('section_id',$section->id) == $section->id ? 'selected':'') }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                    @error('section_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label>ملاحظات</label>
                        <textarea class="form-control" name="description">{{old('description',$products->description)}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-main-primary ">
                        اضافة
                    </button>
                </form>
            </div>
        </div>
        <!-- End Basic modal -->

    </div>

@endsection
