@extends('layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">لوحة التحكم</h1>
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('customers.create') }}" class="btn btn-sm btn-primary">
                    اضافة عميل جديد <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('payments.create') }}" class="btn btn-sm btn-info">
                    اضافة دفعة جديدة <i class="fas fa-plus"></i>
                </a>
            </div>

        </div>

    </div>

    @include('common.alert')


    <div class="row">
        <div class="col-md-12">
{{--            <h2 class="text-center mb-3">اهلا وسهلا ب لوحة التحكم!</h2>--}}
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-3">
            <h4 class="text-right">العملاء</h4>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{route('customers.index.customers')}}" class="text-primary"> عملاء (شهري)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customers}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{route('customers.index')}}" class="text-warning"> عملاء الجدد (شهري)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customers_new}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ route('customers.index.adverser') }}" class="text-info">المتعسرين (شهري)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customers_adverser}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ route('customers.index.rejected') }}" class="text-success">المرفوضين (شهري)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customers_rejects}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ route('customers.index.follow') }}" class="text-primary">المتابعة (شهري)</a>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$customers_follow}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-alt fa-2x text-gray-300"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ route('customers.index.committed') }}" class="text-warning">الملتزمين (شهري)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customers_committed}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-12 mb-3 mt-3">
            <hr>
        </div>

        <div class="col-lg-12 mb-3">
            <h4 class="text-right">الإضافات</h4>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{route('transactions.index')}}" class="text-primary">المعاملات الحالية (شهري)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customers_tasks}}</div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ route('transactions.index.all') }}" class="text-warning">المعاملات (شهري)</a>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$transactions}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 1.1rem">
                                قيمة المعاملات (شهري)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$transaction_amount}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ route('drafts.index') }}" class="text-success">الكمبيالات (شهري)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$drafts}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ route('issues.index') }}" class="text-primary">القضايا (شهري)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$issues}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 mb-3 mt-3">
            <hr>
        </div>

        <div class="col-lg-12 mb-3">
            <h4 class="text-right">نماذج طباعة</h4>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/كمبيالة_1.docx') }}" target="_blank" class="text-primary">كمبيالة نموذج - 1</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/كمبيالة_3.docx') }}" target="_blank" class="text-warning">كمبيالة نموذج - 3</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/كمبيالة_6.docx') }}" target="_blank" class="text-info">كمبيالة نموذج - 6</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/كمبيالة_9.docx') }}" target="_blank" class="text-success">كمبيالة نموذج - 9</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/وصلة_استلام_بضاعة.docx') }}" target="_blank" class="text-primary">وصلة استلام بضاعة</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/وكالة_محامي.docx') }}" target="_blank" class="text-warning">وكالة محامي</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/اقرار.docx') }}" target="_blank" class="text-info">اقرار</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/تصديق_الاتفاق.docx') }}" target="_blank" class="text-success">تصديق الاتفاق</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/اصدار_قرار.docx') }}" target="_blank" class="text-primary">اصدار قرار</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/عميل.docx') }}" target="_blank" class="text-warning">نموذج عميل</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ asset('wordOffice/قضية.docx') }}" target="_blank" class="text-info">نموذج قضية</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-print fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</div>
@endsection
