@extends('layouts.app')

@section('title', 'بيانات المعاملات الحالية')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">المعاملات الحالية</h1>
            <div class="row">
{{--                <div class="col-md-6">--}}
{{--                        <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary">--}}
{{--                            اضافة جديد <i class="fas fa-plus"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="col-md-12">
                        <a href="{{ route('transactions.index.all') }}" class="btn btn-sm btn-success">
                            جميع المعاملات <i class="fas fa-check"></i>
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">كل المعاملات الحالية</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="10%">رقم الإستدلالي</th>
                            <th width="15%">الإسم كامل</th>
                            <th width="10%">رقم الهوية</th>
                            <th width="10%">رقم الجوال</th>
                            <th width="5%">المنطقة</th>
                            <th width="15%">العنوان</th>
                            <th width="5%">الحالة</th>
                            <th width="5%">عدد المعاملات</th>
                            <th width="10%">اضافة معاملة</th>
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
                                    @if($customer->status == 'مقبول' || $customer->status == 'مكتمل')
                                        <span class="text-success">{{ $customer->status }}</span>
                                    @elseif($customer->status == 'مرفوض' || $customer->status == 'متعسر')
                                        <span class="text-danger">{{ $customer->status }}</span>
                                    @elseif($customer->status == 'قيد التوقيع')
                                        <span class="text-warning">{{ $customer->status }}</span>
                                    @else
                                        {{ $customer->status }}
                                    @endif
                                </td>
                                <td>{{$customer->transactions->count()}}</td>
                                <td style="display: flex">
                                    <a href="{{ route('transactions.create', ['customer' => $customer->id]) }}"
                                       class="btn btn-primary m-2">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">No record</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>


                    {{ $customers->links() }}
                </div>
            </div>
        </div>

    </div>

{{--    @include('transactions.delete-modal')--}}

@endsection

@section('scripts')

@endsection
