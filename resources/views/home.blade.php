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

        <div class="col-lg-10 mb-3">
            <h4 class="text-right">العملاء</h4>
        </div>

        <div class="col-lg-2 mb-3">
            <select name="state" id="state" style="height: 45px;" class="form-control form-control-user">
                <option value="شهري" selected>شهري</option>
                <option value="سنوي">سنوي</option>
            </select>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{route('customers.index.customers')}}" class="text-primary"> عملاء (<span class="customers_state">شهري</span>)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 customers">{{$customers}}</div>
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
                                <a href="{{route('customers.index')}}" class="text-warning"> عملاء الجدد (<span class="customers_new_state">شهري</span>)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 customers_new">{{$customers_new}}</div>
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
                                <a href="{{ route('customers.index.adverser') }}" class="text-info">المتعسرين (<span class="customers_adverser_state">شهري</span>)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 customers_adverser">{{$customers_adverser}}</div>
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
                                <a href="{{ route('customers.index.rejected') }}" class="text-success">المرفوضين (<span class="customers_rejects_state">شهري</span>)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 customers_rejects">{{$customers_rejects}}</div>
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
                                <a href="{{ route('customers.index.follow') }}" class="text-primary">المتابعة (<span class="customers_follow_state">شهري</span>)</a>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 customers_follow">{{$customers_follow}}</div>
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
                                <a href="{{ route('customers.index.committed') }}" class="text-warning">الملتزمين (<span class="customers_committed_state">شهري</span>)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 customers_committed">{{$customers_committed}}</div>
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
                                <a href="{{route('transactions.index')}}" class="text-primary">المعاملات الحالية (<span class="customers_tasks_state">شهري</span>)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 customers_tasks">{{$customers_tasks}}</div>

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
                                <a href="{{ route('transactions.index.all') }}" class="text-warning">المعاملات (<span class="transactions_state">شهري</span>)</a>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 transactions">{{$transactions}}</div>
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
                                قيمة المعاملات (<span class="transaction_amount_state">شهري</span>)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 transaction_amount">{{$transaction_amount}}</div>
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
                                <a href="{{ route('drafts.index') }}" class="text-success">الكمبيالات (<span class="drafts_state">شهري</span>)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 drafts">{{$drafts}}</div>
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
                                <a href="{{route('issues.index')}}" class="text-primary">القضايا الحالية (<span class="drafts_tasks_state">شهري</span>)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 drafts_tasks">{{$drafts_tasks}}</div>

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
                                <a href="{{ route('issues.index.all') }}" class="text-warning">القضايا (<span class="issues_state">شهري</span>)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 issues">{{$issues}}</div>
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

{{--        <div class="col-xl-3 col-md-6 mb-4 text-right">--}}
{{--            <div class="card border-left-primary shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">--}}
{{--                                <a href="{{ asset('wordOffice/كمبيالة_1.docx') }}" target="_blank" class="text-primary">كمبيالة نموذج - 1</a></div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="las la-print fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        @foreach($forms as $form)
            <div class="col-xl-3 col-md-6 mb-4 text-right">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                    <a href="{{ asset('forms/'.$form->path) }}" target="_blank" class="text-primary">{{$form->name}}</a></div>
                            </div>
                            <div class="col-auto">
                                <i class="las la-print fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-xl-3 col-md-6 mb-4 text-right">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                <a href="{{route('import')}}" class="text-info">اضافة نموذج</a></div>
                        </div>
                        <div class="col-auto">
                            <i class="las la-plus-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</div>
@endsection


@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

                $(document).on('change', '#state', function(e) {
                    let state = $(this).val();
                    console.log(state)
                        $.ajax({
                            url: "{{ route('state') }}",
                            method: 'POST',
                            data: {
                                state: state,
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    console.log(res)
                                    $('.issues').html(res.issues)
                                    $('.issues_state').html(res.state)

                                    $('.customers').html(res.customers)
                                    $('.customers_state').html(res.state)

                                    $('.customers_adverser').html(res.customers_adverser)
                                    $('.customers_adverser_state').html(res.state)

                                    $('.transaction_amount').html(res.transaction_amount)
                                    $('.transaction_amount_state').html(res.state)

                                    $('.transactions').html(res.transactions)
                                    $('.transactions_state').html(res.state)

                                    $('.customers_new').html(res.customers_new)
                                    $('.customers_new_state').html(res.state)

                                    $('.customers_tasks').html(res.customers_tasks)
                                    $('.customers_tasks_state').html(res.state)

                                    $('.customers_rejects').html(res.customers_rejects)
                                    $('.customers_rejects_state').html(res.state)

                                    $('.customers_follow').html(res.customers_follow)
                                    $('.customers_follow_state').html(res.state)

                                    $('.customers_committed').html(res.customers_committed)
                                    $('.customers_committed_state').html(res.state)

                                    $('.drafts').html(res.drafts)
                                    $('.drafts_state').html(res.state)

                                }
                            },
                        });
                });
        });
    </script>

@endsection
