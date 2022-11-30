@extends('layouts.app')

@section('title', 'ملف القضية')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-3 text-gray-800">ملف القضية</h1>
            {{--            <form action="{{route('customers.export.WORD')}}" method="POST">--}}
            {{--                @csrf--}}
            {{--                <input type="hidden" name="customer_id" value="{{$customer->id}}">--}}
            {{--                <button class="btn btn-success" type="submit"><i class="las la-print"></i></button>--}}

            {{--            </form>--}}
            <div>
                {{--                <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$customer->id}}">--}}
                {{--                    <i class="fas fa-trash"></i>--}}
                {{--                </a>--}}
                <a href="{{ route('issues.export.WORD', ['issue' => $issue->id]) }}" class="btn btn-success m-2">
                    <i class="las la-print"></i>
                </a>
                <a href="{{ route('issues.edit', ['issue' => $issue->id]) }}"
                   class="btn btn-primary m-2">
                    <i class="fa fa-pen"></i>
                </a>

            </div>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        {{-- Page Content --}}
        <div class="row">
            <div class="col-md-12 border-right">


                {{-- Drafts --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">القضايا</h4>
                    @if($issue->case_number == null)
                        <h6 class="text-danger">لا يمكن تصديق القضية</h6>
                    @else
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h6 class="text-success">تصديق الاتفاق</h6>
                            <a class="btn btn-info m-2" href="#" data-toggle="modal" data-target="#ratifyModal">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    @endif


                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">القضية</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="5%">رقم</th>
                                    <th width="10%">إنشاء بواسطة</th>
                                    <th width="10%">اسم المحكمة</th>
                                    <th width="10%">رقم القضية</th>
                                    <th width="10%">مبلغ القضية</th>
                                    <th width="10%">طالب التنفيذ</th>
                                    <th width="10%">وكيل طالب التنفيذ</th>
                                    <th width="10%">وكيل المنفذ ضده</th>
                                    <th width="5%">العملة</th>
                                    <th width="5%">السند</th>
                                    <th width="10%">الحاله</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $issue->issue_NO }}</td>
                                    <td>{{ $issue->UserIssue->full_name }}</td>
                                    <td>{{ $issue->court_name }}</td>
                                    <td>{{ $issue->case_number }}</td>
                                    <td>{{ $issue->case_amount }}</td>
                                    <td>{{ $issue->execution_request_idIssue->agent_name ?? null}}</td>
                                    <td>{{ $issue->execution_agent_name_idIssue->agent_name ?? null}}</td>
                                    <td>{{ $issue->execution_agent_against_it_idIssue->agent_name ?? null}}</td>
                                    <td>{{ $issue->currency_type }}</td>
                                    <td>{{ $issue->bond_type }}</td>
                                    <td>{{ $issue->issue_status }}</td>

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
                        <h6 class="m-0 font-weight-bold text-primary text-right">القضية</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <h6 class="text-right">{{$issue->notes}}</h6>

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
                                    <th width="10%">رقم الإستدلالي</th>
                                    <th width="15%">الإسم كامل</th>
                                    <th width="10%">رقم الهوية</th>
                                    <th width="10%">رقم الجوال</th>
                                    <th width="5%">المنطقة</th>
                                    <th width="15%">العنوان</th>
                                    <th width="5%">الحالة</th>
                                    <th width="5%">الحساب</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($issue->customerIssues as $customer)
                                    <tr>
                                        <td>
                                            <a href="{{route('customers.show',['customer' => $customer->customer_id])}}">{{ $customer->IssueCustomer->customer_NO }}</a>
                                        </td>
                                        <td>{{ $customer->IssueCustomer->full_name }}</td>
                                        <td>{{ $customer->IssueCustomer->ID_NO }}</td>
                                        <td>{{ $customer->IssueCustomer->phone_NO }}</td>
                                        <td>{{ $customer->IssueCustomer->region }}</td>
                                        <td>{{ $customer->IssueCustomer->address }}</td>
                                        <td>
                                            @if($customer->IssueCustomer->status == 'مقبول' || $customer->IssueCustomer->status == 'مكتمل' || $customer->IssueCustomer->status == 'ملتزم')
                                                <span class="text-success">{{ $customer->IssueCustomer->status }}</span>
                                            @elseif($customer->IssueCustomer->status == 'مرفوض' || $customer->IssueCustomer->status == 'متعسر')
                                                <span class="text-danger">{{ $customer->IssueCustomer->status }}</span>
                                            @elseif($customer->IssueCustomer->status == 'قيد التوقيع')
                                                <span class="text-warning">{{ $customer->IssueCustomer->status }}</span>
                                            @elseif($customer->IssueCustomer->status == 'قيد العمل')
                                                <span class="text-info">{{ $customer->IssueCustomer->status }}</span>
                                            @else
                                                {{ $customer->IssueCustomer->status }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($customer->IssueCustomer->account > 0)
                                                <span class="text-danger">{{ $customer->IssueCustomer->account }}</span>

                                            @elseif($customer->IssueCustomer->account < 0)
                                                <span
                                                    class="text-success">{{ $customer->IssueCustomer->account }}</span>
                                            @else
                                                {{ $customer->IssueCustomer->account }}
                                            @endif
                                        </td>
                                        {{--                                        <td>--}}
                                        {{--                                            <a href="" class="btn btn-success m-2">--}}
                                        {{--                                                <i class="las la-print"></i>--}}
                                        {{--                                            </a>--}}
                                        {{--                                        </td>--}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">لا يوجد بيانات</td>
                                    </tr>
                                @endforelse


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">ملاحظات</h4>
                </div>

                @forelse($issue->customerIssues as $customer)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-right">
                                العميل {{$customer->IssueCustomer->full_name}}</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <h6 class="text-right">{{$customer->IssueCustomer->notes ?? 'لا يوجد ملاحظات'}}</h6>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-right">لا يوجد ملاحظات</h6>

                        </div>
                    </div>
                @endforelse


            </div>


        </div>


    </div>


    @include('issues.ratify-modal')

@endsection



