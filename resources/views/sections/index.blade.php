@extends('layouts.master')
@section('title')
    الاقسام
@endsection

@section('content')
    <!-- breadcrumb -->

    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                الاقسام</span>
            </div>
        </div>
    </div>
    @include('layouts.includes.alerts.success')
    @include('layouts.includes.alerts.errors')
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-4">
                    <a class=" btn btn-primary "
                       href="{{route('sections.create')}}">اضافة قسم</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="border-bottom-0">أسم القسم</th>
                                <th class="border-bottom-0">الملاحضات</th>
                                <th class="border-bottom-0">مدخل القسم</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->description }}</td>
                                    <td>{{ $section->created_by }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info mx-1"
                                           href="{{route('sections.edit',$section->id)}}"
                                           title="تعديل"><i class="las la-pen fa-2x"></i></a>
                                        <a class="btn btn-sm btn-danger mx-1" href="#" id="delete"
                                           data-id="{{$section->id}}"
                                           title="حذف"><i
                                                class="las la-trash fa-2x"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{$sections->links()}}
            </div>
        </div>
        @endsection
        @section('js')
            <script>
                $(document).on('click', '#delete', function () {
                    var id = $(this).attr('data-id');
                    var token = $('meta[name="csrf-token"]').attr('content')
                    var dialog = bootbox.confirm({
                        message: "هل انت متأكد من عملية الحذف ؟",
                        callback: function (result) {
                            console.log(result);
                            if (result === false) {
                                dialog.modal('hide');

                            } else {
                                $.ajax({
                                    type: 'DELETE',
                                    url: '{{url('/sections')}}' + "/" + id,
                                    dataType: 'json',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function () {
                                        bootbox.alert({
                                            message: "تم الحذف بنجاح ",
                                            className: 'bb-alternate-modal'
                                        });
                                        setTimeout(function () {
                                            location.reload();
                                        }, 2000)
                                    },
                                });
                            }
                        }
                    });
                });
            </script>
@endsection
