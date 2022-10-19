<table class="table user_table">
    <thead class="table-light">
    <tr>
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
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $key => $customer)
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
        </tr>
    @endforeach
    </tbody>
</table>
