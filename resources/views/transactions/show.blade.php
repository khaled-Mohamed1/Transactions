@extends('layouts.app')

@section('title', 'ملف المعاملة')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-3 text-gray-800">ملف المعاملة</h1>
            <div>
                <a href="{{ route('transactions.edit', ['transaction' => $transaction->id]) }}"
                   class="btn btn-primary m-2">
                    <i class="fa fa-pen"></i>
                </a>
{{--                <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$transaction->id}}">--}}
{{--                    <i class="fas fa-trash"></i>--}}
{{--                </a>--}}

            </div>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        {{-- Page Content --}}
        <div class="row">
            <div class="col-md-12 border-right">


                {{-- Drafts --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">المعاملات</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">المعاملة</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="12%">رقم المعاملة</th>
                                    <th width="10%">رقم الإستدلالي</th>
                                    <th width="10%">اسم العميل</th>
                                    <th width="10%">نوع المعاملة</th>
                                    <th width="13%">قيمة المعاملة</th>
                                    <th width="10%">أول دفعة</th>
                                    <th width="15%">باقي قيمة المعاملة</th>
                                    <th width="10%">وقت إنشاء</th>
                                    <th width="10%">حالة العميل</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <tr>
                                    <td>{{ $transaction->transaction_NO }}</td>
                                    <td><a href="{{route('customers.show',['customer' => $transaction->CustomerTransaction->id])}}">{{ $transaction->CustomerTransaction->customer_NO }}</a></td>
                                    <td>{{ $transaction->CustomerTransaction->full_name }}</td>
                                    <td>{{ $transaction->transactions_type }}</td>
                                    <td>{{ $transaction->transaction_amount }}</td>
                                    <td>{{ $transaction->first_payment }}</td>
                                    <td>{{ $transaction->transaction_rest }}</td>
                                    <td>{{$transaction->created_at}}</td>
                                    <td>
                                        @if($transaction->CustomerTransaction->status == 'مقبول' || $transaction->CustomerTransaction->status == 'مكتمل' || $transaction->CustomerTransaction->status == 'ملتزم')
                                            <span class="text-success">{{ $transaction->CustomerTransaction->status }}</span>
                                        @elseif($transaction->CustomerTransaction->status == 'مرفوض' || $transaction->CustomerTransaction->status == 'متعسر' )
                                            <span class="text-danger">{{ $transaction->CustomerTransaction->status }}</span>
                                        @elseif($transaction->CustomerTransaction->status == 'قيد العمل')
                                            <span class="text-info">{{ $transaction->CustomerTransaction->status }}</span>
                                        @else                                        {{ $transaction->CustomerTransaction->status }}
                                        @endif
                                    </td>
                                </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">معلومات أساسية للعملاء</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">العميل</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="15%">رقم الإستدلالي</th>
                                    <th width="15%">الإسم كامل</th>
                                    <th width="10%">رقم الهوية</th>
                                    <th width="10%">رقم الجوال</th>
                                    <th width="5%">المنطقة</th>
                                    <th width="15%">العنوان</th>
                                    <th width="5%">الحالة</th>
                                    <th width="15%">تاريخ إنشاء</th>
                                    <th width="5%">الحساب</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{route('customers.show',['customer' => $transaction->CustomerTransaction->id])}}">{{ $transaction->CustomerTransaction->customer_NO }}</a></td>

                                        <td>{{ $transaction->CustomerTransaction->full_name }}</td>
                                        <td>{{ $transaction->CustomerTransaction->ID_NO }}</td>
                                        <td>{{ $transaction->CustomerTransaction->phone_NO }}</td>
                                        <td>{{ $transaction->CustomerTransaction->region }}</td>
                                        <td>{{ $transaction->CustomerTransaction->address }}</td>
                                        <td>
                                            @if($transaction->CustomerTransaction->status == 'مقبول' || $transaction->CustomerTransaction->status == 'مكتمل' || $transaction->CustomerTransaction->status == 'ملتزم')
                                                <span class="text-success">{{ $transaction->CustomerTransaction->status }}</span>
                                            @elseif($transaction->CustomerTransaction->status == 'مرفوض' || $transaction->CustomerTransaction->status == 'متعسر')
                                                <span class="text-danger">{{ $transaction->CustomerTransaction->status }}</span>
                                            @elseif($transaction->CustomerTransaction->status == 'قيد التوقيع')
                                                <span class="text-warning">{{ $transaction->CustomerTransaction->status }}</span>
                                            @elseif($transaction->CustomerTransaction->status == 'قيد العمل')
                                                <span class="text-info">{{ $transaction->CustomerTransaction->status }}</span>
                                            @else
                                                {{ $transaction->CustomerTransaction->status }}
                                            @endif
                                        </td>
                                        <td>{{ $transaction->CustomerTransaction->created_at }}</td>
                                        <td>
                                            @if($transaction->CustomerTransaction->account > 0)
                                                <span class="text-danger">{{ $transaction->CustomerTransaction->account }}</span>

                                            @elseif($transaction->CustomerTransaction->account < 0)
                                                <span class="text-success">{{ $transaction->CustomerTransaction->account }}</span>
                                            @else
                                                {{ $transaction->CustomerTransaction->account }}
                                            @endif
                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">ملاحظات</h4>
                </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-right">العميل {{$transaction->CustomerTransaction->full_name}}</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <h6 class="text-right">{{$transaction->CustomerTransaction->notes ?? 'لا يوجد ملاحظات'}}</h6>

                            </div>
                        </div>
                    </div>


            </div>



        </div>



    </div>



@endsection



