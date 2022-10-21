@extends('layouts.app')

@section('title', 'تعديل الموظف')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">تعديل عميل</h1>
            <a href="{{route('customers.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">تعديل عميل جديد</h6>
            </div>
            <form method="POST" action="{{route('customers.update', ['customer' => $customer->id])}}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group row">

                        {{-- full_name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>الإسم كامل <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('full_name') is-invalid @enderror"
                                id="exampleFull_Name"
                                name="full_name"
                                value="{{ old('full_name') ? old('full_name') : $customer->full_name}}">

                            @error('full_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('ID_NO') is-invalid @enderror"
                                id="exampleID_NO"
                                name="ID_NO"
                                value="{{ old('ID_NO') ? old('ID_NO') : $customer->ID_NO }}">

                            @error('ID_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- phone_NO --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>رقم الجوال <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('phone_NO') is-invalid @enderror"
                                id="examplephone_NO"
                                name="phone_NO"
                                value="{{ old('phone_NO') ? old('phone_NO') : $customer->phone_NO}}">

                            @error('phone_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- region --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>المنطقة <span style="color:red;">*</span></label>
                            <select name="region" class="form-control form-control-user @error('region') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="الشمال" {{  $customer->region == 'الشمال' ? 'selected' : '' }}>الشمال</option>
                                <option value="غزة" {{  $customer->region == 'غزة' ? 'selected' : '' }}>غزة</option>
                                <option value="وسطى" {{  $customer->region == 'وسطى' ? 'selected' : '' }}>الوسطى</option>
                                <option value="خانيونس" {{  $customer->region == 'خانيونس' ? 'selected' : '' }}>خانيونس</option>
                                <option value="رفح" {{  $customer->region == 'رفح' ? 'selected' : '' }}>رفح</option>
                            </select>

                            @error('region')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>العنوان كامل <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('address') is-invalid @enderror"
                                id="exampleaddress"
                                name="address"
                                value="{{ old('address') ? old('address') : $customer->address}}">

                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- status --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>الحالة </label>
                            <select name="status" id="status" class="form-control form-control-user h-50 @error('status') is-invalid @enderror"
                                    style="height: 40px">
                                @if($customer->status == 'مكتمل')
                                    <option value="{{$customer->status}}">{{$customer->status}}</option>
                                @else
                                    <option value="{{$customer->status}}">{{$customer->status}}</option>
                                @endif
                                <option value="جديد" {{old('status') ? ((old('status') == 'جديد') ? 'selected' : '')
                                                        : (($customer->status == 'جديد') ? 'selected' : '')}}>جديد</option>
                                <option value="مقبول" {{old('status') ? ((old('status') == 'مقبول') ? 'selected' : '')
                                                        : (($customer->status == 'مقبول') ? 'selected' : '')}}>مقبول</option>
                                <option value="مرفوض" {{old('status') ? ((old('status') == 'مرفوض') ? 'selected' : '')
                                                        : (($customer->status == 'مرفوض') ? 'selected' : '')}}>مرفوض</option>
                            </select>

                            @error('status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- Account --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>الحساب </label>
                            <input
                                type="text"
                                class="form-control form-control-user h-50 @error('account') is-invalid @enderror"
                                id="exampleaccount"
                                name="account"
                                value="{{ old('account') ? old('account') : $customer->account}}">

                            @error('account')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div id="display" class="form-group row m-auto" style="display: none">
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>نوع المعاملة </label>
                                <select name="transactions_type" class="form-control form-control-user @error('transactions_type') is-invalid @enderror"
                                style="height: 40px">
                                    <option selected disabled value="">أختر...</option>
                                    <option value="ودي" {{ old('transactions_type') == 'ودي' ? 'selected' : '' }}>ودي</option>
                                    <option value="استقطاع" {{ old('transactions_type') == 'استقطاع' ? 'selected' : '' }}>استقطاع</option>
                                    <option value="شيكات" {{ old('transactions_type') == 'شيكات' ? 'selected' : '' }}>شيكات</option>
                                    <option value="قروض" {{ old('transactions_type') == 'قروض' ? 'selected' : '' }}>قروض</option>
                                </select>

                                @error('transactions_type')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- transaction_amount --}}
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>قيمة المعاملة </label>
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
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>أول دفعة </label>
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
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>باقي قيمة المعاملة </label>
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
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>قيمة الدفعة الشهرية </label>
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
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>تاريخ أول دفعة </label>
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
                        </div>
                        {{-- transactions_type --}}


                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">تعديل</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('customers.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            if ($("#status").val() === 'مقبول') {
                $("#display").show();
                console.log($('show',"#status").val())
            } else {
                $("#display").hide();
                console.log('hide',$("#status").val())
            }

            $("#status").on("change", function() {
                if ($(this).val() == 'مقبول') {
                    $("#display").show().siblings();
                } else {
                    $("#display").hide();
                }
            })
        });
    </script>

@endsection
