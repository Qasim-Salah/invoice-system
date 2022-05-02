@extends('layouts.master')


@section('title')

    تعديل الصلاحيات@endsection


@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                 تعديل صلاحيات</span>
            </div>
        </div>
    </div>
    @include('layouts.includes.alerts.success')
    @include('layouts.includes.alerts.errors')
    <div class="row">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافةالمنتجات</h6>
            </div>

            <div class="modal-body">
                <form class="form"
                      action="{{route('roles.update',$role -> id)}}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <h4 class="form-section"><i class="ft-home"></i> البيانات الاساسية
                            للصلاحية </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> اسم الصلاحية
                                    </label>
                                    <input type="text" id="name"
                                           class="form-control"
                                           placeholder="  "
                                           value="{{ $role->name }}"
                                           name="name">
                                    @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                @foreach (config('invoice-system.permissions') as $name => $value)
                                    <div class="form-group col-sm-4">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" class="chk-box"
                                                   name="permissions[]"
                                                   value="{{ $name }}" {{ in_array($name, $role->permissions)? 'checked' : '' }}> {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('categories.0')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-warning mr-1"
                                onclick="history.back();">
                            <i class="ft-x"></i> تراجع
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> تحديث
                        </button>
                    </div>
                </form>


            </div>
        </div>
        <!-- End Basic modal -->

    </div>
@stop

@section('script')

    <script>
        $('input:radio[name="type"]').change(
            function () {
                if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                    $('#cats_list').removeClass('hidden');

                } else {
                    $('#cats_list').addClass('hidden');
                }
            });
    </script>
@stop
