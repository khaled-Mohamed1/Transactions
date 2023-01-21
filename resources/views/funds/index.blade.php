@extends('layouts.app')

@section('title', 'بيانات الصندوق')

@section('content')
    <div class="container-fluid">

        {{-- Alert Messages --}}
        @include('common.alert')

        <div class="row">
            <div class="col-xl-4 col-md-4 mb-4 text-right">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                    <a href="#" class="text-primary">مبلغ الصندوق</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$fund->financial}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-coins fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 mb-4 text-right">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                    <a href="#" class="text-info">الصادر</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$payments->sum('payment_amount')}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 mb-4 text-right">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                    <a href="#" class="text-success">الوارد</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$purchases->sum('total_price')}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">الصندوق</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('funds.create') }}" class="btn btn-sm btn-primary">
                        الصندوق <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>

        </div>



        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">الصادر</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th width="10%">رقم الدفعة</th>
                            <th width="10%">إنشاء بواسطة</th>
                            <th width="10%">قيمة الدفعة</th>
                            <th width="10%">نوع العملة</th>
                            <th width="15%">تاريخ الدفع</th>
                            <th width="20%">ملاحظات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse ($payments as $key => $payment)
                            <tr>
                                <td>{{ $payment->payment_NO }}</td>
                                <td>{{ $payment->UserPayment->full_name }}</td>
                                <td>{{ $payment->payment_amount }}</td>
                                <td>{{ $payment->currency_type }}</td>
                                <td>{{ $payment->created_at }}</td>
                                <td>{{ $payment->notes }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">لا يوجد بيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{$payments->links()}}
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">الوارد</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th width="10%">رقم</th>
                            <th width="10%">إنشاء بواسطة</th>
                            <th width="10%">رقم المعاملة</th>
                            <th width="15%">اسم المنتج</th>
                            <th width="15%">الكمية</th>
                            <th width="15%">السعر الكلي</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse ($purchases as $key => $purchase)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $purchase->UserPurchase->full_name }}</td>
                                <td>{{ $purchase->TransactionPurchase->transaction_NO ?? null}}</td>
                                <td>{{ $purchase->StorePurchase->product_name }}</td>
                                <td>{{ $purchase->product_qty }}</td>
                                <td>{{ $purchase->total_price }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">لا يوجد بيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{$purchases->links()}}

                </div>
            </div>
        </div>

    </div>


@endsection

@section('scripts')

@endsection
