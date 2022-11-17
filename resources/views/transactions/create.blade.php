@extends('layouts.app')

@section('title', 'اضافة معاملة')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">اضافة معاملة</h1>
            <a href="{{route('transactions.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">اضافة معاملة جديد</h6>
            </div>
            <form method="POST" action="{{route('transactions.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- customer_id --}}
{{--                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">--}}
{{--                            <label>اسم العميل <span style="color:red;">*</span></label>--}}
{{--                            <select name="customer_id" id="customer_id" class="form-control form-control-user @error('customer_id') is-invalid @enderror">--}}
{{--                                <option selected disabled value="">اختار...</option>--}}
{{--                                @foreach($customers as $customer)--}}
{{--                                    <option value="{{$customer->id}}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{$customer->full_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
                            <input
                                type="hidden"
                                class="form-control form-control-user"
                                id="customer_id"
                                name="customer_id"
                                value="{{$customer->id}}">
{{--                        </div>--}}

                        {{-- full_name --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الأسم كامل</label>
                            <input
                                {{--                                disabled--}}
                                type="text"
                                class="form-control form-control-user @error('full_name') is-invalid @enderror"
                                id="full_name"
                                name="full_name"
                            value="{{$customer->full_name}}">
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
                                class="form-control form-control-user @error('customer_NO') is-invalid @enderror"
                                id="customer_NO"
                                name="customer_NO"
                            value="{{$customer->customer_NO}}">
                            @error('customer_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية</label>
                            <input
                                {{--                                disabled--}}
                                type="text"
                                class="form-control form-control-user @error('ID_NO') is-invalid @enderror"
                                id="ID_NO"
                                name="ID_NO"
                            value="{{$customer->ID_NO}}">
                            @error('ID_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        {{-- phone_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>رقم الجوال</label>
                            <input
{{--                                disabled--}}
                                type="text"
                                class="form-control form-control-user @error('phone_NO') is-invalid @enderror"
                                id="phone_NO"
                                name="phone_NO"
                            value="{{$customer->phone_NO}}">
                            @error('phone_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- region --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>المنطقة</label>
                            <input
{{--                                disabled--}}
                                type="text"
                                class="form-control form-control-user @error('region') is-invalid @enderror"
                                id="region"
                                name="region"
                            value="{{$customer->region}}">
                            @error('region')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>العنوان</label>
                            <input
{{--                                disabled--}}
                                type="text"
                                class="form-control form-control-user @error('address') is-invalid @enderror"
                                id="address"
                                name="address"
                            value="{{$customer->address}}">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- account --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>الحساب</label>
                            <input
{{--                                disabled--}}
                                type="text"
                                class="form-control form-control-user @error('account') is-invalid @enderror"
                                id="account"
                                name="account"
                            value="{{$customer->account}}">
                            @error('account')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transactions_type --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>نوع المعاملة <span style="color:red;">*</span></label>
                            <select name="transactions_type" class="form-control form-control-user @error('transactions_type') is-invalid @enderror"
                                    style="height: 40px">
                                <option  disabled selected>اختر...</option>
                                <option value="ودي" {{ old('transactions_type') == 'ودي' ? 'selected' : '' }}>ودي</option>
                                <option value="استقطاع" {{ old('transactions_type') == 'استقطاع' ? 'selected' : '' }}>استقطاع</option>
                                <option value="شيكات" {{ old('transactions_type') == 'شيكات' ? 'selected' : '' }}>شيكات</option>
                                <option value="قروض" {{ old('transactions_type') == 'قروض' ? 'selected' : '' }}>قروض</option>
                            </select>
                            @error('transactions_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- reserve_phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم البديل </label>
                            <input
                                type="text"
                                class="form-control form-control-user"
                                id="examplereserve_phone_NO"
                                name="reserve_phone_NO"
                                value="{{ $customer->reserve_phone_NO }}">

{{--                            @error('reserve_phone_NO')--}}
{{--                            <span class="text-danger">{{$message}}</span>--}}
{{--                            @enderror--}}
                        </div>

                        {{-- date_of_birth --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>تاريخ الميلاد <span style="color:red;">*</span></label>
                            <input
                                type="date"
                                class="form-control form-control-user @error('date_of_birth') is-invalid @enderror"
                                id="exampledate_of_birth"
                                name="date_of_birth"
                                value="{{ $customer->date_of_birth }}">

                            @error('date_of_birth')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- marital_status --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الحالة الإجتماعية <span style="color:red;">*</span></label>
                            <select name="marital_status" class="form-control form-control-user @error('marital_status') is-invalid @enderror">
                                <option disabled {{ $customer->marital_status == null ? 'selected' : '' }}>اختر...</option>
                                <option value="اعزب" {{ $customer->marital_status == 'اعزب' ? 'selected' : '' }}>اعزب</option>
                                <option value="متزوج" {{ $customer->marital_status == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                                <option value="مطلق" {{ $customer->marital_status == 'مطلق' ? 'selected' : '' }}>مطلق</option>
                            </select>

                            @error('marital_status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- number_of_children --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>أفراد العائلة <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('number_of_children') is-invalid @enderror"
                                id="examplenumber_of_children"
                                name="number_of_children"
                                min="0"
                                value="{{ $customer->number_of_children }}">

                            @error('number_of_children')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- job --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الوظيفة</label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('job') is-invalid @enderror"
                                id="ejob"
                                name="job"
                                value="{{ $customer->job  }}">

                            @error('job')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- salary --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>الدخل</label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('salary') is-invalid @enderror"
                                id="salary"
                                name="salary"
                                min="0"
                                value="{{ $customer->salary  }}">

                            @error('salary')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_name --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك</label>
                            <select name="bank_name" class="form-control form-control-user @error('bank_name') is-invalid @enderror">
                                <option disabled {{ $customer->bank_name == null ? 'selected' : '' }}>اختر...</option>
                                <option value="بنك فلسطين" {{ $customer->bank_name == 'بنك فلسطين' ? 'selected' : '' }}>بنك فلسطين</option>
                                <option value="بنك القدس" {{ $customer->bank_name == 'بنك القدس' ? 'selected' : '' }}>بنك القدس</option>
                                <option value="البنك الإسلامي الفلسطيني" {{ $customer->bank_name == 'البنك الإسلامي الفلسطيني' ? 'selected' : '' }}>البنك الإسلامي الفلسطيني</option>
                                <option value="البنك العقاري المصري العربي" {{ $customer->bank_name == 'البنك العقاري المصري العربي' ? 'selected' : '' }}>البنك العقاري المصري العربي</option>
                                <option value="بنك الوطني الاسلامي" {{ $customer->bank_name == 'بنك الوطني الاسلامي' ? 'selected' : '' }}>بنك الوطني الاسلامي</option>
                                <option value="بنك الانتاج الفلسطيني" {{ $customer->bank_name == 'بنك الانتاج الفلسطيني' ? 'selected' : '' }}>بنك الانتاج الفلسطيني</option>
                                <option value="بنك الأردن" {{ $customer->bank_name == 'بنك الأردن' ? 'selected' : '' }}>بنك الأردن</option>
                                <option value="بنك القاهرة عمان" {{ $customer->bank_name == 'بنك القاهرة عمان' ? 'selected' : '' }}>بنك القاهرة عمان</option>
                                <option value="بنك الاستثمار الفلسطيني" {{ $customer->bank_name == 'بنك الاستثمار الفلسطيني' ? 'selected' : '' }}>بنك الاستثمار الفلسطيني</option>
                                <option value="البنك العربي" {{ $customer->bank_name == 'البنك العربي' ? 'selected' : '' }}>البنك العربي</option>
                                <option value="البنك الاسلامي العربي" {{ $customer->bank_name == 'البنك الاسلامي العربي' ? 'selected' : '' }}>البنك الاسلامي العربي</option>
                                <option value="بنك الاسكان للتجارة والتمويل" {{ $customer->bank_name == 'بنك الاسكان للتجارة والتمويل' ? 'selected' : '' }}>بنك الاسكان للتجارة والتمويل</option>
                                <option value="البنك التجاري الأردني" {{ $customer->bank_name == 'البنك التجاري الأردني' ? 'selected' : '' }}>البنك التجاري الأردني</option>
                                <option value="البنك الأهلي الأردني" {{ $customer->bank_name == 'البنك الأهلي الأردني' ? 'selected' : '' }}>البنك الأهلي الأردني</option>
                                <option value="البنك الوطني" {{ $customer->bank_name == 'البنك الوطني' ? 'selected' : '' }}>البنك الوطني</option>
                                <option value="البريد" {{ $customer->bank_name == 'البريد' ? 'selected' : '' }}>البريد</option>
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
                                id="bank_branch"
                                name="bank_branch"
                                value="{{ $customer->bank_branch }}">

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
                                id="bank_account_NO"
                                name="bank_account_NO"
                                value="{{ $customer->bank_branch }}">

                            @error('bank_account_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transaction_amount --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>قيمة المعاملة <span style="color:red;">*</span></label>
                            <input

                                type="number"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="transaction_amount"
                                name="transaction_amount">

                            @error('transaction_amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- first_payment --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>أول دفعة <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="first_payment"
                                name="first_payment">
                            @error('first_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transaction_rest --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>باقي قيمة المعاملة <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="transaction_rest"
                                name="transaction_rest">
                            @error('transaction_rest')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- monthly_payment --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>قيمة الدفعة الشهرية <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="monthly_payment"
                                name="monthly_payment">
                            @error('monthly_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- date_of_first_payment --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>تاريخ أول دفعة <span style="color:red;">*</span></label>
                            <input
                                type="date"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="date_of_first_payment"
                                name="date_of_first_payment">
                            @error('date_of_first_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- draft_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>عدد الكمبيالات <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('draft_NO') is-invalid @enderror"
                                id="draft_NO"
                                name="draft_NO"
                                min="0"
                                value="4">

                            @error('draft_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        {{-- agency_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>عدد الوكالات <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('agency_NO') is-invalid @enderror"
                                id="agency_NO"
                                name="agency_NO"
                                min="0"
                                value="4">

                            @error('agency_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- endorsement_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>عدد الإستقراء <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('endorsement_NO') is-invalid @enderror"
                                id="endorsement_NO"
                                name="endorsement_NO"
                                min="0"
                                value="1">

                            @error('endorsement_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- receipt_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>عدد الوصل <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('receipt_NO') is-invalid @enderror"
                                id="receipt_NO"
                                name="receipt_NO"
                                min="0"
                                value="1">

                            @error('receipt_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- notes --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>الملاحظات </label>
                            <textarea class="form-control form-control-user"
                                      name="notes"  rows="3">{{ $customer->notes  }}</textarea>
                        </div>


                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">اضافة</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('transactions.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection



