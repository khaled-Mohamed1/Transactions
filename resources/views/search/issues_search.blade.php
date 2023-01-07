    @extends('layouts.app')

    @section('title', 'نتائج البحث')

    @section('content')
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">القضايا</h1>
            </div>

            {{-- Alert Messages --}}
            @include('common.alert')


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-right">نتائج البحث عن القضايا</h6>

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

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">لا يوجد بيانات</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>


    @endsection

    @section('scripts')

    @endsection
