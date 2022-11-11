<table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th scope="col">رقم</th>
        <th scope="col">إنشاء بواسطة</th>
        <th scope="col">اسم المحكمة</th>
        <th scope="col">رقم القضية</th>
        <th scope="col">مبلغ القضية</th>
        <th scope="col">طالب التنفيذ</th>
        <th scope="col">الأطراف</th>
        <th scope="col">الوكيل</th>
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
            <td>{{ $issue->execution_request }}</td>
            <td>
                @foreach($issue->cusotmerIssues as $customer)
                    {{ $customer->IssueCustomer->customer_NO }} -
                @endforeach
            </td>
            <td>{{ $issue->agent_name }}</td>
            <td>{{ $issue->issue_status }}</td>
            <td>{{ $issue->notes }}</td>
            <td>{{ $issue->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
