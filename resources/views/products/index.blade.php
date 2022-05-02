@extends('layouts.master')
@section('title')
    المنتجات
@endsection

@section('content')
    <!-- breadcrumb -->

    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                المنتجات</span>
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
                       href="{{route('products.create')}}">اضافة منتج</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="border-bottom-0">اسم المنتج</th>
                                <th class="border-bottom-0">اسم القسم</th>
                                <th class="border-bottom-0">ملاحظات</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->section->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{route('products.edit',$product->id)}}"
                                               title="تعديل"><i class="las la-pen fa-2x"></i></a>
                                            <a class="btn btn-sm btn-danger" href="#" id="delete" data-id="{{$product->id}}"
                                               title="حذف"><i
                                                    class="las la-trash fa-2x"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{$products->links()}}
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
                                    url: '{{url('/products')}}' + "/" + id,
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
                                    }
                                });
                            }
                        }
                    });
                });
            </script>
@endsection

