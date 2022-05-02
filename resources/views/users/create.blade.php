@extends('layouts.master')

@section('title')
    اضافة مستخدم -  للادارة القانونية
@stop

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة
                مستخدم</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('users') }}">رجوع</a>
                        </div>
                    </div>
                    <br>
                    @include('layouts.includes.alerts.success')
                    @include('layouts.includes.alerts.errors')
                    <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                          action="{{route('users.store')}}" method="POST">
                        @csrf
                        <div class="">
                            <div class="row mg-b-20">
                                <div class="parsley-input col-md-6" id="fnWrapper">
                                    <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                                    <input class="form-control form-control-sm mg-b-20"
                                           data-parsley-class-handler="#lnWrapper" name="name" required="" autocomplete="off" type="text">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                                    <input class="form-control form-control-sm mg-b-20"
                                           data-parsley-class-handler="#lnWrapper" name="email" required="" type="email">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>كلمة المرور: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                       name="password" required="" autocomplete="off" type="password">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                                <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                                       name="confirm-password" required="" type="password">
                                @error('confirm_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-lg-6">
                                <label class="form-label">حالة المستخدم</label>
                                <select name="value_status" id="select-beast" class="form-control  nice-select  custom-select">
                                    <option>--</option>
                                    <option value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>
                                </select>
                                @error('value_status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">حالة المستخدم</label>
                                <select name="role_id" class="select2 form-control">
                                    <optgroup label="من فضلك أختر الصلاحية ">
                                        @if($roles && $roles -> count() > 0)
                                            @foreach($roles as $role)
                                                <option
                                                    value="{{$role -> id }}">{{$role -> name}}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                </select>
                                @error('role_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-main-primary pd-x-20" type="submit">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
