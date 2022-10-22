@extends('layouts.app')

@section('title', 'تعديل المعاملة')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">تعديل المعاملة</h1>
            <a href="{{route('transactions.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
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

                        {{-- customer_id --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم العميل <span style="color:red;">*</span></label>
                            <select name="customer_id" id="customer_id" class="form-control form-control-user @error('customer_id') is-invalid @enderror"
                            style="height: 40px">
                                    <option value="{{$transaction->CustomerTransaction->id}}">{{$transaction->CustomerTransaction->full_name}}</option>
                            </select>

                            @error('customer_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="ID_NO"
                                name="ID_NO"
                                value="{{$transaction->CustomerTransaction->ID_NO}}">

                        </div>

                        {{-- phone type --}}
                        <div class="col-sm-1 mb-3 mt-3 mb-sm-0">
                            <label>نوع الجوال </label>
                            <select name="phone_type" id="phone_type" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                <option value="جوال" {{ old('phone_type') == 'جوال' ? 'selected' : '' }}>جوال</option>
                                <option value="وطنية" {{ old('phone_type') == 'وطنية' ? 'selected' : '' }}>وطنية</option>
                            </select>
                        </div>

                        {{-- phone_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>رقم الجوال</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="phone_NO"
                                name="phone_NO"
                                value="{{$transaction->CustomerTransaction->phone_NO}}">
                        </div>

                        {{-- region --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>المنطقة</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="region"
                                name="region"
                                value="{{$transaction->CustomerTransaction->region}}">
                        </div>

                        {{-- address --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>العنوان</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="address"
                                name="address"
                                value="{{$transaction->CustomerTransaction->address}}">
                        </div>

                        {{-- account --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الحساب</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="account"
                                name="account"
                                value="{{$transaction->CustomerTransaction->account}}">
                        </div>

                        {{-- transactions_type --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>نوع المعاملة <span style="color:red;">*</span></label>
                            <input type="hidden" name="transactions_type" value="{{$transaction->transactions_type}}">
                            <select name="transactions_type" disabled class="form-control form-control-user"
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
                            <label>رقم البديل <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('reserve_phone_NO') is-invalid @enderror"
                                id="examplereserve_phone_NO"
                                name="reserve_phone_NO"
                                value="{{ $transaction->CustomerTransaction->reserve_phone_NO }}">

                            @error('reserve_phone_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- date_of_birth --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>تاريخ الميلاد <span style="color:red;">*</span></label>
                            <input
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
                            <select name="marital_status" class="form-control form-control-user @error('marital_status') is-invalid @enderror">
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

                        {{-- job --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الوظيفة</label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('job') is-invalid @enderror"
                                id="examplejob"
                                name="job"
                                value="{{ $transaction->CustomerTransaction->job }}">

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
                                <option selected disabled value="">اختر...</option>
                                <option value="بنك فلسطين" {{ old('marital_status') == 'بنك فلسطين' ? 'selected' : '' }}>بنك فلسطين</option>
                                <option value="بنك القدس" {{ old('marital_status') == 'بنك القدس' ? 'selected' : '' }}>بنك القدس</option>
                                <option value="البنك الإسلامي الفلسطيني" {{ old('marital_status') == 'البنك الإسلامي الفلسطيني' ? 'selected' : '' }}>البنك الإسلامي الفلسطيني</option>
                                <option value="البنك العقاري المصري العربي" {{ old('marital_status') == 'البنك العقاري المصري العربي' ? 'selected' : '' }}>البنك العقاري المصري العربي</option>
                                <option value="بنك الوطني الاسلامي" {{ old('marital_status') == 'بنك الوطني الاسلامي' ? 'selected' : '' }}>بنك الوطني الاسلامي</option>
                                <option value="بنك الانتاج الفلسطيني" {{ old('marital_status') == 'بنك الانتاج الفلسطيني' ? 'selected' : '' }}>بنك الانتاج الفلسطيني</option>
                                <option value="بنك الأردن" {{ old('marital_status') == 'بنك الأردن' ? 'selected' : '' }}>بنك الأردن</option>
                                <option value="بنك القاهرة عمان" {{ old('marital_status') == 'بنك القاهرة عمان' ? 'selected' : '' }}>بنك القاهرة عمان</option>
                                <option value="بنك الاستثمار الفلسطيني" {{ old('marital_status') == 'بنك الاستثمار الفلسطيني' ? 'selected' : '' }}>بنك الاستثمار الفلسطيني</option>
                                <option value="البنك العربي" {{ old('marital_status') == 'البنك العربي' ? 'selected' : '' }}>البنك العربي</option>
                                <option value="البنك الاسلامي العربي" {{ old('marital_status') == 'البنك الاسلامي العربي' ? 'selected' : '' }}>البنك الاسلامي العربي</option>
                                <option value="بنك الاسكان للتجارة والتمويل" {{ old('marital_status') == 'بنك الاسكان للتجارة والتمويل' ? 'selected' : '' }}>بنك الاسكان للتجارة والتمويل</option>
                                <option value="البنك التجاري الأردني" {{ old('marital_status') == 'البنك التجاري الأردني' ? 'selected' : '' }}>البنك التجاري الأردني</option>
                                <option value="البنك الأهلي الأردني" {{ old('marital_status') == 'البنك الأهلي الأردني' ? 'selected' : '' }}>البنك الأهلي الأردني</option>
                                <option value="البنك الوطني" {{ old('marital_status') == 'البنك الوطني' ? 'selected' : '' }}>البنك الوطني</option>
                                <option value="البريد" {{ old('marital_status') == 'البريد' ? 'selected' : '' }}>البريد</option>
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
                                disabled
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
                                disabled
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
                                disabled
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
                                disabled
                                type="date"
                                class="form-control form-control-user  @error('date_of_first_payment') is-invalid @enderror"
                                id="exampledate_of_first_payment"
                                name="date_of_first_payment"
                                value="{{ $transaction->date_of_first_payment }}">
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
                                value="{{ $transaction->draft_NO  ?? 4}}">

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
                                value="{{ $transaction->agency_NO  ?? 4}}">

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
                                value="{{ $transaction->endorsement_NO  ?? 1}}">

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
                                value="{{ $transaction->receipt_NO  ?? 1}}">

                            @error('receipt_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">تعديل</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('transactions.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">

        $(document).ready(function() {
            $("#phone_type").on("change", function() {
                if ($(this).val() == 'جوال') {
                    $("#phone_NO").val('059')
                } else {
                    $("#phone_NO").val('056');
                }
            })
        });

    </script>

@endsection

