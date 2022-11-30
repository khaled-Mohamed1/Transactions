@extends('layouts.app')

@section('title', 'بيانات المعاملات')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">المعاملات</h1>
            <div class="row">
                {{--                <div class="col-md-6">--}}
                {{--                        <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary">--}}
                {{--                            اضافة جديد <i class="fas fa-plus"></i>--}}
                {{--                    </a>--}}
                {{--                </div>--}}
                <div class="col-md-12">
                    <a href="{{ route('transactions.export') }}" class="btn btn-sm btn-success">
                        تصدير اكسل <i class="fas fa-check"></i>
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">كل المعاملات</h6>

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
                            <th width="10%">العمليات</th>

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
                                <td style="display: flex">
                                    <a href="{{ route('transactions.edit', ['transaction' => $transaction->id]) }}"
                                       class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$transaction->id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="10">لا يوجد بيانات</td>
                            </tr>

                        @endforelse
                        </tbody>
                    </table>

                    {{ $transactions->links() }}
                </div>
            </div>
        </div>

    </div>

        @include('transactions.delete-modal')

@endsection

@section('scripts')

@endsection
