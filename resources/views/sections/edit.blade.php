@extends('layouts.master')
@section('title')
    تعديل الاقسام
@stop

@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                 تعديل الاقسام</span>
            </div>
        </div>
    </div>
    @include('layouts.includes.alerts.success')
    @include('layouts.includes.alerts.errors')
    <div class="row">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل قسم</h6>
            </div>

            <div class="modal-body">
                <form action="{{ route('sections.update',$sections->id) }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group mb-3">
                        <label>اسم القسم</label>
                        <input type="text" class="form-control" value="{{old('name',$sections->name)}} " name="name">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label>ملاحظات</label>
                        <textarea class="form-control" name="description"> {{old('description',$sections->description)}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-main-primary mt-3 mb-5">
                            تحديث
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Basic modal -->

    </div>

@endsection
