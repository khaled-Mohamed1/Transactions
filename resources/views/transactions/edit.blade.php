@extends('layouts.app')

@section('title', 'تعديل المعاملة')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">تعديل المعاملة</h1>
            <a href="{{route('customers.show',['customer' => $transaction->CustomerTransaction->id])}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">تعديل المعاملة</h6>
            </div>
            <form method="POST" action="{{route('transactions.update', ['transaction' => $transaction->id])}}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group row">

                        <input
                            type="hidden"
                            class="form-control form-control-user"
                            id="customer_id"
                            name="customer_id"
                            value="{{$transaction->CustomerTransaction->id}}">

                        {{-- customer_id --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الأسم كامل</label>
                            <input
                                                                disabled
                                type="text"
                                class="form-control form-control-user @error('full_name') is-invalid @enderror"
                                id="full_name"
                                name="full_name"
                                value="{{$transaction->CustomerTransaction->full_name}}">
                            @error('full_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- customer_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الإستدلالي</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="customer_NO"
                                name="customer_NO"
                                value="{{$transaction->CustomerTransaction->customer_NO}}">

                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية</label>
                            <input
                                                                disabled
                                type="text"
                                class="form-control form-control-user @error('ID_NO') is-invalid @enderror"
                                id="ID_NO"
                                name="ID_NO"
                                value="{{$transaction->CustomerTransaction->ID_NO}}">
                            @error('ID_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- phone_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>رقم الجوال</label>
                            <input
                                                                disabled
                                type="text"
                                class="form-control form-control-user @error('phone_NO') is-invalid @enderror"
                                id="phone_NO"
                                name="phone_NO"
                                value="{{$transaction->CustomerTransaction->phone_NO}}">
                            @error('phone_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- region --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>المنطقة</label>
                            <input
                                                                disabled
                                type="text"
                                class="form-control form-control-user @error('region') is-invalid @enderror"
                                id="region"
                                name="region"
                                value="{{$transaction->CustomerTransaction->region}}">
                            @error('region')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>العنوان</label>
                            <input
                                                                disabled
                                type="text"
                                class="form-control form-control-user @error('address') is-invalid @enderror"
                                id="address"
                                name="address"
                                value="{{$transaction->CustomerTransaction->address}}">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- account --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>الحساب</label>
                            <input
                                                                disabled
                                type="text"
                                class="form-control form-control-user @error('account') is-invalid @enderror"
                                id="account"
                                name="account"
                                value="{{$transaction->CustomerTransaction->account}}">
                            @error('account')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transactions_type --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>نوع المعاملة <span style="color:red;">*</span></label>
                            <input type="hidden" name="transactions_type" value="{{$transaction->transactions_type}}">
                            <select name="transactions_type" class="form-control form-control-user"
                            style="height: 40px">
                                <option  {{ $transaction->transactions_type == null ? 'selected' : '' }}></option>
                                <option value="ودي" {{ $transaction->transactions_type == 'ودي' ? 'selected' : '' }}>ودي</option>
                                <option value="استقطاع" {{ $transaction->transactions_type == 'استقطاع' ? 'selected' : '' }}>استقطاع</option>
                                <option value="شيكات" {{ $transaction->transactions_type == 'شيكات' ? 'selected' : '' }}>شيكات</option>
                                <option value="قروض" {{ $transaction->transactions_type == 'قروض' ? 'selected' : '' }}>قروض</option>
                            </select>

                        </div>


                        {{-- reserve_phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم البديل </label>
                            <input
                                type="text"
                                class="form-control form-control-user"
                                id="examplereserve_phone_NO"
                                name="reserve_phone_NO"
                                value="{{ $transaction->CustomerTransaction->reserve_phone_NO }}">
                        </div>

                        {{-- date_of_birth --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>تاريخ الميلاد <span style="color:red;">*</span></label>
                            <input
                                disabled
                                type="date"
                                class="form-control form-control-user @error('date_of_birth') is-invalid @enderror"
                                id="exampledate_of_birth"
                                placeholder="Date Of Birth"
                                name="date_of_birth"
                                value="{{ $transaction->CustomerTransaction->date_of_birth }}">

                            @error('date_of_birth')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- marital_status --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الحالة الإجتماعية <span style="color:red;">*</span></label>
                            <select name="marital_status" disabled class="form-control form-control-user @error('marital_status') is-invalid @enderror">
                                <option disabled {{ $transaction->CustomerTransaction->marital_status == null ? 'selected' : '' }}>اختر...</option>
                                <option value="اعزب" {{ $transaction->CustomerTransaction->marital_status == 'اعزب' ? 'selected' : '' }}>اعزب</option>
                                <option value="متزوج" {{ $transaction->CustomerTransaction->marital_status == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                                <option value="مطلق" {{ $transaction->CustomerTransaction->marital_status == 'مطلق' ? 'selected' : '' }}>مطلق</option>
                            </select>

                            @error('marital_status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- number_of_children --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>أفراد العائلة <span style="color:red;">*</span></label>
                            <input
                                disabled
                                type="number"
                                class="form-control form-control-user @error('number_of_children') is-invalid @enderror"
                                id="examplenumber_of_children"
                                name="number_of_children"
                                min="0"
                                value="{{ $transaction->CustomerTransaction->number_of_children }}">

                            @error('number_of_children')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_name --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك </label>
                            <select name="bank_name"  disabled style="height: 45px"
                                    class="form-control form-control-user @error('bank_name') is-invalid @enderror">
                                <option disabled {{ $transaction->CustomerTransaction->bank_name == null ? 'selected' : '' }}>اختر...</option>
                                @foreach($jobs as $job)
                                    <option value="{{$job->id}}" {{ $transaction->CustomerTransaction->CustomerJob->name == $job->name ? 'selected' : '' }}>{{$job->name}}</option>
                                @endforeach
                            </select>

                            @error('bank_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- salary --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>الدخل</label>
                            <input
                                disabled
                                type="number"
                                class="form-control form-control-user @error('salary') is-invalid @enderror"
                                id="examplejob"
                                name="salary"
                                min="0"
                                value="{{ $transaction->CustomerTransaction->salary }}">

                            @error('salary')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_name --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك</label>
                            <select name="bank_name" class="form-control form-control-user @error('bank_name') is-invalid @enderror"
                            style="height: 40px;">
                                <option disabled {{ $transaction->CustomerTransaction->CustomerBank->name == null ? 'selected' : '' }}>اختر...</option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}" {{ $transaction->CustomerTransaction->CustomerBank->name == $bank->name ? 'selected' : '' }}>{{$bank->name}}</option>
                                @endforeach
                            </select>
                            @error('bank_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_branch --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>فرع البنك</label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('bank_branch') is-invalid @enderror"
                                id="examplebank_branch"
                                name="bank_branch"
                                value="{{ $transaction->CustomerTransaction->bank_branch }}">

                            @error('bank_branch')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_account_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>رقم حساب البنك</label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('bank_account_NO') is-invalid @enderror"
                                id="examplebank_account_NO"
                                name="bank_account_NO"
                                value="{{ $transaction->CustomerTransaction->bank_account_NO }}">

                            @error('bank_account_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transaction_amount --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>قيمة المعاملة <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user  @error('transaction_amount') is-invalid @enderror"
                                id="exampletransaction_amount"
                                name="transaction_amount"
                                min="0"
                                value="{{ $transaction->transaction_amount }}">
                            @error('transaction_amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- first_payment --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>أول دفعة <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user  @error('first_payment') is-invalid @enderror"
                                id="examplefirst_payment"
                                name="first_payment"
                                min="0"
                                value="{{ $transaction->first_payment }}">
                            @error('first_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transaction_rest --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>باقي قيمة المعاملة <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user  @error('transaction_rest') is-invalid @enderror"
                                id="exampletransaction_rest"
                                name="transaction_rest"
                                min="0"
                                value="{{ $transaction->transaction_rest }}">
                            @error('transaction_rest')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- monthly_payment --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>قيمة الدفعة الشهرية <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-use  @error('monthly_payment') is-invalid @enderror"
                                id="examplemonthly_payment"
                                name="monthly_payment"
                                min="0"
                                value="{{ $transaction->monthly_payment }}">
                            @error('monthly_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- date_of_first_payment --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>تاريخ أول دفعة <span style="color:red;">*</span></label>
                            <input
                                type="date"
                                class="form-control form-control-user  @error('date_of_first_payment') is-invalid @enderror"
                                id="exampledate_of_first_payment"
                                name="date_of_first_payment"
                                value="{{ $transaction->date_of_first_payment }}">
                            @error('date_of_first_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- notes --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>الملاحظات </label>
                            <textarea class="form-control form-control-user" disabled
                                      name="notes"  rows="3">{{ $transaction->CustomerTransaction->notes  }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">تعديل</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('customers.show',['customer' => $transaction->CustomerTransaction->id]) }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection


