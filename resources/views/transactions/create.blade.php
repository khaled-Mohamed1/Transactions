@extends('layouts.app')

@section('title', 'Add Transaction')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Transaction</h1>
            <a href="{{route('transactions.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Transaction</h6>
            </div>
            <form method="POST" action="{{route('transactions.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- customer_id --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Customer Name</label>
                            <select name="customer_id" id="customer_id" class="form-control form-control-user @error('customer_id') is-invalid @enderror">
                                <option selected disabled value="">Choose...</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{$customer->full_name}}</option>
                                @endforeach
                            </select>

                            @error('customer_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>ID NO</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="ID_NO"
                                name="ID_NO">
                        </div>

                        {{-- phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>Phone NO</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="phone_NO"
                                name="phone_NO">
                        </div>

                        {{-- region --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>Region</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="region"
                                name="region">
                        </div>

                        {{-- address --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>Address</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="address"
                                name="address">
                        </div>

                        {{-- account --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>Account</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="account"
                                name="account">
                        </div>

                        {{-- transactions_type --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Transactions Type</label>
                            <select name="transactions_type" class="form-control form-control-user @error('transactions_type') is-invalid @enderror">
                                <option selected disabled value="">Choose...</option>
                                <option value="ودي" {{ old('transactions_type') == 'ودي' ? 'selected' : '' }}>ودي</option>
                                <option value="استقطاع" {{ old('transactions_type') == 'استقطاع' ? 'selected' : '' }}>استقطاع</option>
                                <option value="شيكات" {{ old('transactions_type') == 'شيكات' ? 'selected' : '' }}>شيكات</option>
                            </select>

                            @error('transactions_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- reserve_phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Reserve Phone NO</label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('reserve_phone_NO') is-invalid @enderror"
                                id="examplereserve_phone_NO"
                                name="reserve_phone_NO"
                                value="{{ old('reserve_phone_NO') }}">

                            @error('reserve_phone_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- date_of_birth --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Date Of Birth</label>
                            <input
                                type="date"
                                class="form-control form-control-user @error('date_of_birth') is-invalid @enderror"
                                id="exampledate_of_birth"
                                placeholder="Date Of Birth"
                                name="date_of_birth"
                                value="{{ old('date_of_birth') }}">

                            @error('date_of_birth')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- marital_status --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Marital Status</label>
                            <select name="marital_status" class="form-control form-control-user @error('marital_status') is-invalid @enderror">
                                <option selected disabled value="">Choose...</option>
                                <option value="اعزب" {{ old('marital_status') == 'اعزب' ? 'selected' : '' }}>اعزب</option>
                                <option value="متزوج" {{ old('marital_status') == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                                <option value="مطلق" {{ old('marital_status') == 'مطلق' ? 'selected' : '' }}>مطلق</option>
                            </select>

                            @error('marital_status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- number_of_children --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label><span style="color:red;">* </span>Number Of Children</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('number_of_children') is-invalid @enderror"
                                id="examplenumber_of_children"
                                name="number_of_children"
                                min="0"
                                value="{{ old('number_of_children') }}">

                            @error('number_of_children')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- job --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>Job</label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('job') is-invalid @enderror"
                                id="examplejob"
                                name="job"
                                value="{{ old('job') }}">

                            @error('job')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- salary --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>Salary</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('salary') is-invalid @enderror"
                                id="examplejob"
                                name="salary"
                                min="0"
                                value="{{ old('salary') }}">

                            @error('salary')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_name --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>Bank Name</label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('bank_name') is-invalid @enderror"
                                id="examplebank_name"
                                name="bank_name"
                                value="{{ old('bank_name') }}">

                            @error('bank_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_branch --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>Bank Branch</label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('bank_branch') is-invalid @enderror"
                                id="examplebank_branch"
                                name="bank_branch"
                                value="{{ old('bank_branch') }}">

                            @error('bank_branch')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_account_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>Bank Account NO</label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('bank_account_NO') is-invalid @enderror"
                                id="examplebank_account_NO"
                                name="bank_account_NO"
                                value="{{ old('bank_account_NO') }}">

                            @error('bank_account_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transaction_amount --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Transaction Amount</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="exampletransaction_amount"
                                name="transaction_amount"
                                min="0"
                                value="{{ old('transaction_amount') }}">

                            @error('transaction_amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- first_payment --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>First Payment</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('first_payment') is-invalid @enderror"
                                id="examplefirst_payment"
                                name="first_payment"
                                min="0"
                                value="{{ old('first_payment') }}">

                            @error('first_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transaction_rest --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Transaction Rest</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('transaction_rest') is-invalid @enderror"
                                id="exampletransaction_rest"
                                name="transaction_rest"
                                min="0"
                                value="{{ old('transaction_rest') }}">

                            @error('transaction_rest')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- monthly_payment --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Monthly Payment</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('monthly_payment') is-invalid @enderror"
                                id="examplemonthly_payment"
                                name="monthly_payment"
                                min="0"
                                value="{{ old('monthly_payment') }}">

                            @error('monthly_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- date_of_first_payment --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Date Of First Payment</label>
                            <input
                                type="date"
                                class="form-control form-control-user @error('date_of_first_payment') is-invalid @enderror"
                                id="exampledate_of_first_payment"
                                name="date_of_first_payment"
                                value="{{ old('date_of_first_payment') }}">

                            @error('date_of_first_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- draft_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Draft NO</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('draft_NO') is-invalid @enderror"
                                id="draft_NO"
                                name="draft_NO"
                                min="0"
                                value="{{ old('draft_NO') }}">

                            @error('draft_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        {{-- agency_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Agency NO</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('agency_NO') is-invalid @enderror"
                                id="agency_NO"
                                name="agency_NO"
                                min="0"
                                value="{{ old('agency_NO') }}">

                            @error('agency_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- endorsement_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Endorsement NO</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('endorsement_NO') is-invalid @enderror"
                                id="endorsement_NO"
                                name="endorsement_NO"
                                min="0"
                                value="{{ old('endorsement_NO') }}">

                            @error('endorsement_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- receipt_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label> <span style="color:red;">* </span>Receipt NO</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('receipt_NO') is-invalid @enderror"
                                id="receipt_NO"
                                name="receipt_NO"
                                min="0"
                                value="{{ old('receipt_NO') }}">

                            @error('receipt_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('transactions.index') }}">Cancel</a>
                </div>
            </form>
        </div>

    </div>

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            let customers = {!! $customers->toJson() !!};

            $(document).ready(function() {
                $(document).on('change', '#customer_id', function(e) {
                    let customer_id = $(this).val();
                    $.ajax({
                        url: "{{ route('transactions.get') }}",
                        method: 'POST',
                        data: {
                            customer_id: customer_id,
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                $('#ID_NO').val(res.customer.ID_NO);
                                $('#phone_NO').val(res.customer.phone_NO);
                                $('#region').val(res.customer.region);
                                $('#address').val(res.customer.address);
                                $('#account').val(res.customer.account);
                            }
                        },
                    });
                });
            });
        });
    </script>

@endsection

