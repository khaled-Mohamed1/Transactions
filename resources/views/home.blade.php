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
                    اضافة جديد <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="col-md-6">

                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> انشاء تقرير</a>
            </div>

        </div>

    </div>

    @include('common.alert')


    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-3">اهلا وسهلا ب لوحة التحكم!</h2>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

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

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{ route('customers.index.follow') }}" class="text-warning">المتابعة (شهري)</a>
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


    </div>



</div>
@endsection
