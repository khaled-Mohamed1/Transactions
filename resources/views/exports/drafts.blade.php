<table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th scope="col">رقم الكمبيالة</th>
        <th  scope="col">إنشاء بواسطة</th>
        <th  scope="col">نوع المستند</th>
        <th  scope="col">عدد الأفراد</th>
        <th  scope="col">عدد المستند</th>
        <th  scope="col">مستند تابع</th>
        <th  scope="col">الأطراف</th>
        <th  scope="col">تاريخ الإنشاء</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($drafts as $draft)
        <tr>
            <td>{{ $draft->draft_NO }}</td>
            <td>{{ $draft->UserDraft->full_name }}</td>
            <td>{{ $draft->document_type }}</td>
            <td>{{ $draft->customer_qty }}</td>
            <td>{{ $draft->document_qty }}</td>
            <td>{{ $draft->document_affiliate }}</td>
            <td>
                @foreach($draft->cusotmerDrafts as $customer)
                    {{ $customer->DraftCustomer->customer_NO }} -
                @endforeach
            </td>
            <td>{{$draft->created_at}}</td>
        </tr>

        @endforeach
    </tbody>
</table>
