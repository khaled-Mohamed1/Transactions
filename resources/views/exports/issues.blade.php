<table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th scope="col">رقم</th>
        <th scope="col">إنشاء بواسطة</th>
        <th scope="col">اسم المحكمة</th>
        <th scope="col">رقم القضية</th>
        <th scope="col">مبلغ القضية</th>
        <th width="10%">العملة</th>
        <th width="10%">السند</th>
        <th width="10%">طالب التنفيذ</th>
        <th width="15%">الأطراف</th>
        <th width="10%">وكيل طالب التنفيذ</th>
        <th width="10%">وكيل المنفذ ضده</th>
        <th scope="col">الحاله</th>
        <th scope="col">ملاحظات</th>
        <th scope="col">تاريخ الإنشاء</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($issues as $issue)
        <tr>
            <td>{{ $issue->issue_NO }}</td>
            <td>{{ $issue->UserIssue->full_name }}</td>
            <td>{{ $issue->court_name }}</td>
            <td>{{ $issue->case_number }}</td>
            <td>{{ $issue->case_amount }}</td>
            <td>{{ $issue->currency_type }}</td>
            <td>{{ $issue->bond_type }}</td>
            <td>{{ $issue->execution_request_idIssue->agent_name ?? null}}</td>
            <td>
                @foreach($issue->cusotmerIssues as $customer)
                    {{ $customer->IssueCustomer->customer_NO }} -
                @endforeach
            </td>
            <td>{{ $issue->execution_agent_name_idIssue->agent_name ?? null}}</td>
            <td>{{ $issue->execution_agent_against_it_idIssue->agent_name ?? null}}</td>
            <td>{{ $issue->issue_status }}</td>
            <td>{{ $issue->notes }}</td>
            <td>{{ $issue->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
