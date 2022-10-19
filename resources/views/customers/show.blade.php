@extends('layouts.app')

@section('title', 'CustomerProfile')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        {{-- Page Content --}}
        <div class="row">
            <div class="col-md-12 border-right">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Main Information</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Customer</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="5%">Customer_NO</th>
                                    <th width="15%">Full_Name</th>
                                    <th width="10%">ID_NO</th>
                                    <th width="10%">Phone_NO</th>
                                    <th width="5%">Region</th>
                                    <th width="20%">Address</th>
                                    <th width="5%">Status</th>
                                    <th width="15%">Created_At</th>
                                    <th width="5%">Account</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $customer->customer_NO }}</td>
                                        <td>{{ $customer->full_name }}</td>
                                        <td>{{ $customer->ID_NO }}</td>
                                        <td>{{ $customer->phone_NO }}</td>
                                        <td>{{ $customer->region }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>
                                            @if($customer->status == 'مقبول' || $customer->status == 'مكتمل')
                                                <span class="text-success">{{ $customer->status }}</span>
                                            @elseif($customer->status == 'مرفوض' || $customer->status == 'متعسر')
                                                <span class="text-danger">{{ $customer->status }}</span>
                                            @else
                                                {{ $customer->status }}
                                            @endif
                                        </td>
                                        <td>{{ $customer->created_at }}</td>
                                        <td>{{ $customer->account }}</td>

                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Secondary Information</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Customer</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="10%">Reserve_Phone+NO</th>
                                    <th width="10%">Date_Of_Birth</th>
                                    <th width="10%">Marital_Status</th>
                                    <th width="10%">Children</th>
                                    <th width="10%">Job</th>
                                    <th width="10%">Salary</th>
                                    <th width="10%">Bank_Name</th>
                                    <th width="10%">Bank_Branch</th>
                                    <th width="10%">Bank_Account_NO</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $customer->reserve_phone_NO }}</td>
                                    <td>{{ $customer->date_of_birth }}</td>
                                    <td>{{ $customer->marital_status }}</td>
                                    <td>{{ $customer->number_of_children }}</td>
                                    <td>{{ $customer->job }}</td>
                                    <td>{{ $customer->salary }}</td>
                                    <td>{{ $customer->bank_name }}</td>
                                    <td>{{ $customer->bank_branch }}</td>
                                    <td>{{ $customer->bank_account_NO }}</td>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Transaction</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Customer</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="5%">Transaction_NO</th>
                                    <th width="5%">Transactions_Type</th>
                                    <th width="5%">Transaction_Amount</th>
                                    <th width="5%">First_Payment</th>
                                    <th width="5%">Transaction_Rest</th>
                                    <th width="5%">Monthly_Payment</th>
                                    <th width="10%">Date_Of_First_Payment</th>
                                    <th width="5%">Draft_NO</th>
                                    <th width="5%">Agency_NO</th>
                                    <th width="5%">Endorsement_NO</th>
                                    <th width="5%">Receipt_NO</th>
                                    <th width="10%">Created_At</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @forelse($customer->transactions as $transaction)
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
                                    @empty
                                        <td colspan="13">No record</td>
                                    @endforelse
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                {{-- Drafts --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Drafts</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Customer</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="30%">Draft_No</th>
                                    <th width="20%">Draft_No</th>
                                    <th width="20%">Draft_No</th>
                                    <th width="20%">Draft_No</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">No record</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                {{-- Issue --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Issues</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Customer</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="30%">Issue_No</th>
                                    <th width="20%">Issue_No</th>
                                    <th width="20%">Issue_No</th>
                                    <th width="20%">Issue_No</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="6">No record</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


                <hr>

                {{-- Attachments --}}
                <div class="p-3 py-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Attachments</h4>
                    </div>
                    <div class="row mt-2">
                        No Attachments
                    </div>
                </div>

            </div>



        </div>



    </div>
@endsection
