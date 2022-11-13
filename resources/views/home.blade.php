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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 1.1rem">
                                عملاء (شهري)</div>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-size: 1.1rem">
                                عملاء الجدد (شهري)</div>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 1.1rem">
                                المتابعة (شهري)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customers_tasks}}</div>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size: 1.1rem">
                                المرفوضين (شهري)</div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 1.1rem">
                                المتعسرين (شهري)</div>
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
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 1.1rem">
                                المعاملات (شهري)
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$transactions}}</div>
                                </div>
{{--                                <div class="col">--}}
{{--                                    <div class="progress progress-sm mr-2">--}}
{{--                                        <div class="progress-bar bg-info" role="progressbar"--}}
{{--                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"--}}
{{--                                            aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-size: 1.1rem">
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size: 1.1rem">
                                الكمبيالات (شهري)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$drafts}}</div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 1.1rem">
                                القضايا (شهري)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$issues}}</div>
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
