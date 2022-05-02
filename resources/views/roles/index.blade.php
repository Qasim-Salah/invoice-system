@extends('layouts.master')

@section('title')

    الصلاحيات
@endsection

@section('content')

    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                الصلاحيات</span>
            </div>
        </div>
    </div>
    @include('layouts.includes.alerts.success')
    @include('layouts.includes.alerts.errors')
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-4">
                    <a class=" btn btn-primary"
                       href="{{route('roles.create')}}">اضافة منتج</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                               style="text-align: center">
                            <thead class="">
                            <tr>
                                <th>الاسم</th>
                                <th>الصلاحيات</th>
                                <th>الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($roles)
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role -> name}}</td>

                                        <td>
                                            @foreach($role -> permissions as $permission)
                                                {{$permission}} ,
                                            @endforeach

                                        </td>
                                        <td>
                                            <div class="btn-group" role="group"
                                                 aria-label="Basic example">
                                                <a href="{{route('roles.edit',$role -> id)}}"
                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
