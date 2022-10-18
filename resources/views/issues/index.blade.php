@extends('layouts.app')

@section('title', 'Issue List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Issue</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('issues.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('issues.export') }}" class="btn btn-sm btn-success">
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
                <h6 class="m-0 font-weight-bold text-primary">All Issue</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="15%">Issue_NO</th>
                            <th width="15%">Issue_NO</th>
                            <th width="15%">Issue_NO</th>
                            <th width="15%">Issue_NO</th>
                            <th width="15%">Created At</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--                        @forelse ($issues as $issue)--}}
                        <tr>
                            {{--                                <td>{{ $draft->transaction_NO }}</td>--}}
                            {{--                                <td>{{ $draft->CustomerTransaction->full_name }}</td>--}}
                            {{--                                <td>{{ $transaction->transactions_type }}</td>--}}
                            {{--                                <td>{{ $transaction->transaction_amount }}</td>--}}
                            {{--                                <td>{{ $transaction->first_payment }}</td>--}}
                            {{--                                <td>{{ $transaction->transaction_rest }}</td>--}}
                            {{--                                <td>{{$transaction->created_at}}</td>--}}
                            {{--                                <td>--}}
                            {{--                                    @if($transaction->CustomerTransaction->status == 'مقبول' || $transaction->CustomerTransaction->status == 'مكتمل')--}}
                            {{--                                        <span class="text-success">{{ $transaction->CustomerTransaction->status }}</span>--}}
                            {{--                                    @elseif($transaction->CustomerTransaction->status == 'مرفوض' || $transaction->CustomerTransaction->status == 'متعسر')--}}
                            {{--                                        <span class="text-danger">{{ $transaction->CustomerTransaction->status }}</span>--}}
                            {{--                                    @else--}}
                            {{--                                        {{ $transaction->CustomerTransaction->status }}--}}
                            {{--                                    @endif--}}
                            {{--                                </td>--}}
                            {{--                                <td style="display: flex">--}}
                            {{--                                    <a href="{{ route('transactions.edit', ['transaction' => $transaction->id]) }}"--}}
                            {{--                                       class="btn btn-primary m-2">--}}
                            {{--                                        <i class="fa fa-pen"></i>--}}
                            {{--                                    </a>--}}
                            {{--                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$transaction->id}}">--}}
                            {{--                                        <i class="fas fa-trash"></i>--}}
                            {{--                                    </a>--}}
                            {{--                                </td>--}}
                        </tr>
                        {{--                        @empty--}}
                        <tr>
                            <td colspan="6">No record</td>
                        </tr>
                        {{--                        @endforelse--}}
                        </tbody>
                    </table>

                    {{--                    {{ $issues->links() }}--}}
                </div>
            </div>
        </div>

    </div>

    @include('issues.delete-modal')

@endsection

@section('scripts')

@endsection
