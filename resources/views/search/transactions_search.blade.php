@extends('layouts.app')

@section('title', 'نتائج البحث')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">المعاملات</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">نتائج البحث عن المعاملات</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th width="12%">رقم المعاملة</th>
                            <th width="10%">رقم الإستدلالي</th>
                            <th width="10%">اسم العميل</th>
                            <th width="10%">نوع المعاملة</th>
                            <th width="13%">قيمة المعاملة</th>
                            <th width="10%">أول دفعة</th>
                            <th width="15%">باقي قيمة المعاملة</th>
                            <th width="10%">وقت إنشاء</th>
                            <th width="10%">حالة العميل</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td><a href="{{route('transactions.show',['transaction' => $transaction->id])}}">{{ $transaction->transaction_NO }}</a></td>
                                <td><a href="{{route('customers.show',['customer' => $transaction->CustomerTransaction->id])}}">{{ $transaction->CustomerTransaction->customer_NO }}</a></td>
                                <td>{{ $transaction->CustomerTransaction->full_name }}</td>
                                <td>{{ $transaction->transactions_type }}</td>
                                <td>{{ $transaction->transaction_amount }}</td>
                                <td>{{ $transaction->first_payment }}</td>
                                <td>{{ $transaction->transaction_rest }}</td>
                                <td>{{$transaction->created_at}}</td>
                                <td>
                                    @if($transaction->CustomerTransaction->status == 'مقبول' || $transaction->CustomerTransaction->status == 'مكتمل' || $transaction->CustomerTransaction->status == 'ملتزم')
                                        <span class="text-success">{{ $transaction->CustomerTransaction->status }}</span>
                                    @elseif($transaction->CustomerTransaction->status == 'مرفوض' || $transaction->CustomerTransaction->status == 'متعسر' )
                                        <span class="text-danger">{{ $transaction->CustomerTransaction->status }}</span>
                                    @elseif($transaction->CustomerTransaction->status == 'قيد العمل')
                                        <span class="text-info">{{ $transaction->CustomerTransaction->status }}</span>
                                    @else                                        {{ $transaction->CustomerTransaction->status }}
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

    </div>


@endsection

@section('scripts')

@endsection
