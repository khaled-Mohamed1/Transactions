@extends('layouts.app')

@section('title', 'بيانات القضايات')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">القضايا</h1>
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('issues.create') }}" class="btn btn-sm btn-primary">
                        اضافة جديد <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('agents.index') }}" class="btn btn-sm btn-info">
                        جميع الوكلاء <i class="fas fa-plus"></i>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('issues.export') }}" class="btn btn-sm btn-success">
                        نصدير اكسل <i class="fas fa-check"></i>
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4 text-right">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                    <a href="#" class="text-primary">عدد القضايا</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$issues->count()}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4 text-right">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size: 1.1rem">
                                    <a href="#" class="text-info">مبلغ الكلي</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$issues->sum('case_amount')}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">كل القضايا</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th width="10%">رقم</th>
                            <th width="10%">إنشاء بواسطة</th>
                            <th width="10%">اسم المحكمة</th>
                            <th width="10%">رقم القضية</th>
                            <th width="10%">مبلغ القضية</th>
                            <th width="10%">طالب التنفيذ</th>
                            <th width="15%">الأطراف</th>
                            <th width="10%">وكيل طالب التنفيذ</th>
                            <th width="10%">وكيل المنفذ ضده</th>
                            <th width="10%">الحاله</th>
                            <th width="10%">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($issues as $issue)
                                <tr>
                                    <td><a href="{{route('issues.show',['issue' => $issue->id])}}">{{ $issue->issue_NO }}</a></td>
                                    <td>{{ $issue->UserIssue->full_name }}</td>
                                    <td>{{ $issue->court_name }}</td>
                                    <td>{{ $issue->case_number }}</td>
                                    <td>{{ $issue->case_amount }}</td>
                                    <td>{{ $issue->execution_request_idIssue->agent_name ?? null}}</td>
                                    <td>
                                        @foreach($issue->customerIssues as $customer)
                                            <a href="{{route('customers.show',['customer' => $customer->customer_id])}}">{{ $customer->IssueCustomer->customer_NO }}</a> -
                                        @endforeach
                                    </td>
                                    <td>{{ $issue->execution_agent_name_idIssue->agent_name ?? null}}</td>
                                    <td>{{ $issue->execution_agent_against_it_idIssue->agent_name ?? null}}</td>
                                    <td>{{ $issue->issue_status }}</td>
                                    <td style="display: flex">
                                        <a href="{{ route('issues.edit', ['issue' => $issue->id]) }}"
                                           class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$issue->id}}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="{{ route('issues.export.WORD', ['issue' => $issue->id]) }}" class="btn btn-success m-2">
                                            <i class="las la-print"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11">لا يوجد بيانات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $issues->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('issues.delete-modal')

@endsection

@section('scripts')

@endsection
