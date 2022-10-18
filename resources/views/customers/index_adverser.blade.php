@extends('layouts.app')

@section('title', 'Customer List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Adverser</h1>
            <div class="row">
{{--                <div class="col-md-6">--}}
{{--                    <a href="{{ route('customers.create') }}" class="btn btn-sm btn-primary">--}}
{{--                        <i class="fas fa-plus"></i> Add New--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="col-md-12">
                    <a href="{{ route('customers.export.adverser') }}" class="btn btn-sm btn-success">
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
                <h6 class="m-0 font-weight-bold text-primary">All Adverser</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="5%">Customer_NO</th>
                            <th width="15%">Full_Name</th>
                            <th width="15%">ID_NO</th>
                            <th width="15%">Phone_NO</th>
                            <th width="5%">Region</th>
                            <th width="15%">Address</th>
                            <th width="5%">Status</th>
                            <th width="10%">Created_by</th>
                            <th width="5%">Account</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td><a href="{{route('customers.show',['customer' => $customer->id])}}">{{ $customer->customer_NO }}</a></td>
                                <td>{{ $customer->full_name }}</td>
                                <td>{{ $customer->ID_NO }}</td>
                                <td>{{ $customer->phone_NO }}</td>
                                <td>{{ $customer->region }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <span class="text-danger">{{ $customer->status }}</span>
                                </td>
                                <td>{{ $customer->UserCustomer->full_name }}</td>
                                <td>{{ $customer->account }}</td>
                                <td style="display: flex">
                                    <a href="{{ route('customers.edit', ['customer' => $customer->id]) }}"
                                       class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$customer->id}}">
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

                    {{ $customers->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('customers.delete-modal')

@endsection

@section('scripts')

@endsection
