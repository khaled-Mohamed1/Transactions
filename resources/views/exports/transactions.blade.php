<table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th scope="col">رقم المعاملة</th>
        <th scope="col">رقم الإستدلالي</th>
        <th scope="col">اسم العميل</th>
        <th scope="col">نوع المعاملة</th>
        <th scope="col">قيمة المعاملة</th>
        <th scope="col">أول دفعة</th>
        <th scope="col">باقي قيمة المعاملة</th>
        <th scope="col">وقت إنشاء</th>
        <th scope="col">حالة العميل</th>

    </tr>
    </thead>
    <tbody>z
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->transaction_NO }}</td>
            <td>{{ $transaction->CustomerTransaction->customer_NO }}</td>
            <td>{{ $transaction->CustomerTransaction->full_name }}</td>
            <td>{{ $transaction->transactions_type }}</td>
            <td>{{ $transaction->transaction_amount }}</td>
            <td>{{ $transaction->first_payment }}</td>
            <td>{{ $transaction->transaction_rest }}</td>
            <td>{{$transaction->created_at}}</td>
            <td>
                @if($transaction->CustomerTransaction->status == 'مقبول' || $transaction->CustomerTransaction->status == 'مكتمل')
                    <span class="text-success">{{ $transaction->CustomerTransaction->status }}</span>
                @elseif($transaction->CustomerTransaction->status == 'مرفوض' || $transaction->CustomerTransaction->status == 'متعسر')
                    <span class="text-danger">{{ $transaction->CustomerTransaction->status }}</span>
                @else
                    {{ $transaction->CustomerTransaction->status }}
                @endif
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
