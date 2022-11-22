<table class="table user_table">
    <thead class="table-light">
    <tr >
        <th scope="col">Customer_NO</th>
        <th scope="col" colspan="2">Full_Name</th>
        <th scope="col" colspan="2">ID_NO</th>
        <th scope="col" colspan="2">Phone_NO</th>
        <th scope="col">Region</th>
        <th scope="col" colspan="2">Address</th>
        <th scope="col">Status</th>
        <th scope="col" colspan="2">Created_At</th>
        <th scope="col">Account</th>
        <th scope="col" colspan="2" >Reserve_Phone+NO</th>
        <th scope="col" colspan="2">Date_Of_Birth</th>
        <th scope="col">Marital_Status</th>
        <th scope="col">Children</th>
        <th scope="col">Job</th>
        <th scope="col">Salary</th>
        <th scope="col" colspan="2">Bank_Name</th>
        <th scope="col" colspan="2">Bank_Branch</th>
        <th scope="col" colspan="2">Bank_Account_NO</th>
        <th scope="col" colspan="2">Transaction_NO</th>
        <th scope="col" colspan="2">Notes</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $customer->customer_NO }}</td>
            <td colspan="2">{{ $customer->full_name }}</td>
            <td colspan="2">{{ $customer->ID_NO }}</td>
            <td colspan="2">{{ $customer->phone_NO }}</td>
            <td>{{ $customer->region }}</td>
            <td colspan="2">{{ $customer->address }}</td>
            <td>
                @if($customer->status == 'مقبول' || $customer->status == 'مكتمل')
                    <span class="text-success">{{ $customer->status }}</span>
                @elseif($customer->status == 'مرفوض' || $customer->status == 'متعسر')
                    <span class="text-danger">{{ $customer->status }}</span>
                @else
                    {{ $customer->status }}
                @endif
            </td>
            <td colspan="2">{{ $customer->created_at }}</td>
            <td>{{ $customer->account }}</td>
            <td colspan="2">{{ $customer->reserve_phone_NO }}</td>
            <td colspan="2">{{ $customer->date_of_birth }}</td>
            <td>{{ $customer->marital_status }}</td>
            <td>{{ $customer->number_of_children }}</td>
            <td>{{ $customer->job }}</td>
            <td>{{ $customer->salary }}</td>
            <td colspan="2">{{ $customer->bank_name }}</td>
            <td colspan="2">{{ $customer->bank_branch }}</td>
            <td colspan="2">{{ $customer->bank_account_NO }}</td>
            <td scope="col" colspan="2">
                @foreach($customer->transactions as $key => $transaction)
                    {{ $transaction->transaction_NO }}
                @endforeach
            </td>
            <td colspan="2">{{$customer->notes}}</td>
        </tr>
    </tbody>
</table>

<br>

<table class="table">
    <thead>
    <tr>
        <th colspan="12">معاملات</th>
    </tr>
    </thead>
</table>

<table class="table user_table">
    <thead class="table-light">
    <tr>
        <th scope="col" colspan="2">رقم المعاملة</th>
        <th scope="col" colspan="2">نوع المعاملة</th>
        <th scope="col" colspan="2">قيمة المعاملة</th>
        <th scope="col" colspan="2">الدفعة الأولى</th>
        <th scope="col" colspan="2">باقي قيمة المعاملة</th>
        <th scope="col" colspan="2">دفعة الشهرية</th>
        <th scope="col" colspan="2">تاريخ أول دفعة</th>
        <th scope="col" colspan="2">عدد الكمبيالات</th>
        <th scope="col" colspan="2">عدد الوكالات</th>
        <th scope="col" colspan="2">عدد الإستقراء</th>
        <th scope="col" colspan="2">عدد الوصل</th>
        <th scope="col" colspan="2">تاريخ الإنشاء</th>
    </tr>
    </thead>
    <tbody>
    @forelse($customer->transactions as $transaction)

        <tr>
            <td>{{ $transaction->transaction_NO }}</td>
            <td>{{ $transaction->transactions_type }}</td>
            <td>{{ $transaction->transaction_amount }}</td>
            <td>{{ $transaction->first_payment }}</td>
            <td>{{ $transaction->transaction_rest }}</td>
            <td>{{ $transaction->monthly_payment }}</td>
            <td>{{ $transaction->date_of_first_payment }}</td>
            <td>{{ $transaction->draft_NO }}</td>
            <td>{{ $transaction->agency_NO }}</td>
            <td>{{ $transaction->endorsement_NO }}</td>
            <td>{{ $transaction->receipt_NO }}</td>
            <td>{{ $transaction->created_at }}</td>

        </tr>
    @empty
        <tr>
            <td colspan="12">لا يوجد بيانات</td>
        </tr>
    @endforelse

    </tbody>
</table>


<br>

<table class="table">
    <thead>
    <tr>
        <th colspan="6">قضايا</th>
    </tr>
    </thead>
</table>

<table class="table user_table">
    <thead class="table-light">
    <tr>
        <th scope="col" colspan="2">رقم الكمبيالة</th>
        <th scope="col" colspan="2">نوع المستند</th>
        <th scope="col" colspan="2">عدد الأفراد</th>
        <th scope="col" colspan="2">عدد المستند</th>
        <th scope="col" colspan="2">مستند تابع</th>
        <th scope="col" colspan="2">تاريخ الإنشاء</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($customer->CustomerDrafts as $draft)
        <tr>
            <td>{{ $draft->DraftCustomerDraft->draft_NO }}</td>
            <td>{{ $draft->DraftCustomerDraft->document_type }}</td>
            <td>{{ $draft->DraftCustomerDraft->customer_qty }}</td>
            <td>{{ $draft->DraftCustomerDraft->document_qty }}</td>
            <td>{{ $draft->DraftCustomerDraft->document_affiliate }}</td>
            <td>{{ $draft->DraftCustomerDraft->created_at }}</td>
        </tr>

        @empty
        <tr>
            <td colspan="6">لا يوجد بيانات</td>
        </tr>
        @endforelse
    </tbody>
</table>

<br>


<table class="table">
    <thead>
    <tr>
        <th colspan="7">الدفعات</th>
    </tr>
    </thead>
</table>


<table class="table user_table">
    <thead class="table-light">
    <tr class="text-info">
        <th scope="col" colspan="2">رقم الدفعة</th>
        <th scope="col" colspan="2">إنشاء بواسطة</th>
        <th scope="col" colspan="2">قيمة الدفعة</th>
        <th scope="col" colspan="2">تاريخ الدفع</th>
        <th scope="col" colspan="2">نوعة الدفعة</th>
        <th scope="col" colspan="2">عن طريق</th>
        <th scope="col" colspan="2">ملاحظات</th>
    </tr>
    </thead>

    <tbody>
    @forelse ($customer->payments as $payment)
        <tr>
            <td>{{ $payment->payment_NO }}</td>
            <td>{{ $payment->UserPayment->full_name }}</td>
            <td>{{ $payment->payment_amount }}</td>
            <td>{{ $payment->created_at }}</td>
            <td>{{ $payment->payment_type }}</td>
            <td>{{ $payment->payment_via }}</td>
            <td>{{ $payment->notes }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7">لا يوجد بيانات</td>
        </tr>
    @endforelse
    </tbody>
</table>
