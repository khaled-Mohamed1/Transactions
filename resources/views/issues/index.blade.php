@extends('layouts.app')

@section('title', 'بيانات القضايات')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">القضايا</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('issues.create') }}" class="btn btn-sm btn-primary">
                        اضافة جديد <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('issues.export') }}" class="btn btn-sm btn-success">
                        نصدير اكسل <i class="fas fa-check"></i>
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

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
                            <th width="10%">الوكيل</th>
                            <th width="10%">الحاله</th>
                            <th width="10%">ملاحظات</th>
                            <th width="10%">تاريخ الإنشاء</th>
                            <th width="10%">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($issues as $issue)
                                <tr>
                                    <td>{{ $issue->issue_NO }}</td>
                                    <td>{{ $issue->UserIssue->full_name }}</td>
                                    <td>{{ $issue->court_name }}</td>
                                    <td>{{ $issue->case_number }}</td>
                                    <td>{{ $issue->case_amount }}</td>
                                    <td>{{ $issue->execution_request }}</td>
                                    <td>
                                        @foreach($issue->cusotmerIssues as $customer)
                                            <a href="{{route('customers.show',['customer' => $customer->customer_id])}}">{{ $customer->IssueCustomer->customer_NO }}</a> -
                                        @endforeach
                                    </td>
                                    <td>{{ $issue->agent_name }}</td>
                                    <td>{{ $issue->issue_status }}</td>
                                    <td>{{ $issue->notes }}</td>
                                    <td>{{ $issue->created_at }}</td>
                                    <td style="display: flex">
{{--                                        <a href="{{ route('transactions.edit', ['transaction' => $transaction->id]) }}"--}}
{{--                                           class="btn btn-primary m-2">--}}
{{--                                            <i class="fa fa-pen"></i>--}}
{{--                                        </a>--}}
                                        <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$issue->id}}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12">لا يوجد بيانات</td>
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
