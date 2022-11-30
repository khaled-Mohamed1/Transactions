@extends('layouts.app')

@section('title', 'ملف الكمبيالة')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-3 text-gray-800">ملف الكمبيالة</h1>
{{--            <form action="{{route('customers.export.WORD')}}" method="POST">--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="customer_id" value="{{$customer->id}}">--}}
{{--                <button class="btn btn-success" type="submit"><i class="las la-print"></i></button>--}}

{{--            </form>--}}
            <div>

                <a href="{{ route('drafts.edit', ['draft' => $draft->id]) }}"
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
                    <h4 class="text-right">الكمبيالات</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">الكمبيالة</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="10%">رقم الكمبيالة</th>
                                    <th width="15%">إنشاء بواسطة</th>
                                    <th width="10%">نوع المستند</th>
                                    <th width="10%">عدد الأفراد</th>
                                    <th width="10%">عدد المستند</th>
                                    <th width="10%">مستند تابع</th>
                                    <th width="10%">تاريخ الإنشاء</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $draft->draft_NO }}</td>
                                        <td>{{ $draft->UserDraft->full_name }}</td>
                                        <td>{{ $draft->document_type }}</td>
                                        <td>{{ $draft->customer_qty }}</td>
                                        <td>{{ $draft->document_qty }}</td>
                                        <td>{{ $draft->document_affiliate }}</td>
                                        <td>{{ $draft->created_at }}</td>

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
                                @forelse($draft->cusotmerdrafts as $customer)
                                    <tr>
                                        <td><a href="{{route('customers.show',['customer' => $customer->DraftCustomer->id])}}">{{ $customer->DraftCustomer->customer_NO }}</a></td>

                                        <td>{{ $customer->DraftCustomer->full_name }}</td>
                                        <td>{{ $customer->DraftCustomer->ID_NO }}</td>
                                        <td>{{ $customer->DraftCustomer->phone_NO }}</td>
                                        <td>{{ $customer->DraftCustomer->region }}</td>
                                        <td>{{ $customer->DraftCustomer->address }}</td>
                                        <td>
                                            @if($customer->DraftCustomer->status == 'مقبول' || $customer->DraftCustomer->status == 'مكتمل' || $customer->DraftCustomer->status == 'ملتزم')
                                                <span class="text-success">{{ $customer->DraftCustomer->status }}</span>
                                            @elseif($customer->DraftCustomer->status == 'مرفوض' || $customer->DraftCustomer->status == 'متعسر')
                                                <span class="text-danger">{{ $customer->DraftCustomer->status }}</span>
                                            @elseif($customer->DraftCustomer->status == 'قيد التوقيع')
                                                <span class="text-warning">{{ $customer->DraftCustomer->status }}</span>
                                            @elseif($customer->DraftCustomer->status == 'قيد العمل')
                                                <span class="text-info">{{ $customer->DraftCustomer->status }}</span>
                                            @else
                                                {{ $customer->DraftCustomer->status }}
                                            @endif
                                        </td>
                                        <td>{{ $customer->DraftCustomer->created_at }}</td>
                                        <td>
                                            @if($customer->DraftCustomer->account > 0)
                                                <span class="text-danger">{{ $customer->DraftCustomer->account }}</span>

                                            @elseif($customer->DraftCustomer->account < 0)
                                                <span class="text-success">{{ $customer->DraftCustomer->account }}</span>
                                            @else
                                                {{ $customer->DraftCustomer->account }}
                                            @endif
                                        </td>
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
                    <h4 class="text-right">القضايا</h4>
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
                                        <th width="10%">رقم</th>
                                        <th width="10%">إنشاء بواسطة</th>
                                        <th width="10%">اسم المحكمة</th>
                                        <th width="10%">رقم القضية</th>
                                        <th width="10%">مبلغ القضية</th>
                                        <th width="10%">طالب التنفيذ</th>
                                        <th width="10%">وكيل طالب التنفيذ</th>
                                        <th width="10%">وكيل المنفذ ضده</th>
                                        <th width="10%">الحاله</th>
                                        <th width="10%">ملاحظات</th>
                                        <th width="10%">تاريخ الإنشاء</th>
                                        {{--                                    <th width="10%">العمليات</th>--}}
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($draft->issues as $issue)
                                        <tr>
                                            <td><a href="{{route('issues.show',['issue' => $issue->IssueCustomerIssue->id])}}">{{ $issue->IssueCustomerIssue->issue_NO }}</a></td>
                                            <td>{{ $issue->IssueCustomerIssue->UserIssue->full_name }}</td>
                                            <td>{{ $issue->IssueCustomerIssue->court_name }}</td>
                                            <td>{{ $issue->IssueCustomerIssue->case_number }}</td>
                                            <td>{{ $issue->IssueCustomerIssue->case_amount }}</td>
                                            <td>{{ $issue->IssueCustomerIssue->execution_request_idIssue->agent_name ?? null }}</td>
                                            <td>{{ $issue->IssueCustomerIssue->execution_agent_name_idIssue->agent_name ?? null }}</td>
                                            <td>{{ $issue->IssueCustomerIssue->execution_agent_against_it_idIssue->agent_name ?? null }}</td>
                                            <td>{{ $issue->IssueCustomerIssue->issue_status }}</td>
                                            <td>{{ $issue->IssueCustomerIssue->notes }}</td>
                                            <td>{{ $issue->IssueCustomerIssue->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11">لا يوجد بيانات</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>




            </div>



        </div>



    </div>



@endsection



