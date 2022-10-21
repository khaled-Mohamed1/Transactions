@extends('layouts.app')

@section('title', 'العملاء المتعسرين')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Adverser</h1>
            <div class="row">
{{--                <div class="col-md-6">--}}
{{--                    <a href="{{ route('customers.create') }}" class="btn btn-sm btn-primary">--}}
{{--                        <i class="fas fa-plus"></i> Add New--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="col-md-12">
                        <a href="{{ route('customers.export.adverser') }}" class="btn btn-sm btn-success">
                            تصدير اكسل <i class="fas fa-check"></i>
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">كل العملاء</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="15%">رقم الإستدلالي</th>
                            <th width="15%">الإسم كامل</th>
                            <th width="10%">رقم الهوية</th>
                            <th width="10%">رقم الجوال</th>
                            <th width="5%">المنطقة</th>
                            <th width="15%">العنوان</th>
                            <th width="5%">الحالة</th>
                            <th width="15%">إنشاء بواسطة</th>
                            <th width="5%">الحساب</th>
                            <th width="10%">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td><a href="{{route('customers.show',['customer' => $customer->id])}}">{{ $customer->customer_NO }}</a></td>
                                <td>{{ $customer->full_name }}</td>
                                <td>{{ $customer->ID_NO }}</td>
                                <td>{{ $customer->phone_NO }}</td>
                                <td>{{ $customer->region }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <span class="text-danger">{{ $customer->status }}</span>
                                </td>
                                <td>{{ $customer->UserCustomer->full_name }}</td>
                                <td>{{ $customer->account }}</td>
                                <td style="display: flex">
                                    <a href="{{ route('customers.edit', ['customer' => $customer->id]) }}"
                                       class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$customer->id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">لا يوجد بيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{ $customers->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('customers.delete-modal')

@endsection

@section('scripts')

@endsection
