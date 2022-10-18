@extends('layouts.app')

@section('title', 'Transactions List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transactions</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('transactions.export') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-check"></i> Export To Excel
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Transactions</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="5%">Transaction_NO</th>
                            <th width="15%">Customer Name</th>
                            <th width="10%">Transactions Type</th>
                            <th width="15%">Transaction Amount</th>
                            <th width="15%">First Payment</th>
                            <th width="15%">Transaction Rest</th>
                            <th width="15%">Created At</th>
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->transaction_NO }}</td>
                                <td>{{ $transaction->CustomerTransaction->full_name }}</td>
                                <td>{{ $transaction->transactions_type }}</td>
                                <td>{{ $transaction->transaction_amount }}</td>
                                <td>{{ $transaction->first_payment }}</td>
                                <td>{{ $transaction->transaction_rest }}</td>
                                <td>{{$transaction->created_at}}</td>
                                <td>{{$transaction->CustomerTransaction->status}}</td>
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
                                <td colspan="9">No record</td>
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
