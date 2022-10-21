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
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم العميل <span style="color:red;">*</span></label>
                            <select name="customer_id" id="customer_id" class="form-control form-control-user @error('customer_id') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
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
                            <label>رقم الهوية</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="ID_NO"
                                name="ID_NO">
                        </div>

                        {{-- phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الجوال</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="phone_NO"
                                name="phone_NO">
                        </div>

                        {{-- region --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>المنطقة</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="region"
                                name="region">
                        </div>

                        {{-- address --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>العنوان</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="address"
                                name="address">
                        </div>

                        {{-- account --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الحساب</label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="account"
                                name="account">
                        </div>

                        {{-- transactions_type --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>نوع المعاملة <span style="color:red;">*</span></label>
                            <select name="transactions_type" disabled class="form-control form-control-user @error('transactions_type') is-invalid @enderror"
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
                            <label>رقم البديل <span style="color:red;">*</span></label>
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
                            <label>تاريخ الميلاد <span style="color:red;">*</span></label>
                            <input
                                type="date"
                                class="form-control form-control-user @error('date_of_birth') is-invalid @enderror"
                                id="exampledate_of_birth"
                                name="date_of_birth"
                                value="{{ old('date_of_birth') }}">

                            @error('date_of_birth')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- marital_status --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الحالة الإجتماعية <span style="color:red;">*</span></label>
                            <select name="marital_status" class="form-control form-control-user @error('marital_status') is-invalid @enderror">
                                <option selected disabled value="">اختر...</option>
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
                            <label>أفراد العائلة <span style="color:red;">*</span></label>
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
                            <label>الوظيفة</label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('job') is-invalid @enderror"
                                id="ejob"
                                name="job"
                                value="{{ old('job') }}">

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
                                value="{{ old('salary') }}">

                            @error('salary')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_name --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك</label>
                            <select name="bank_name" class="form-control form-control-user @error('bank_name') is-invalid @enderror">
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
                                id="bank_branch"
                                name="bank_branch"
                                value="{{ old('bank_branch') }}">

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
                                value="{{ old('bank_account_NO') }}">

                            @error('bank_account_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transaction_amount --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>قيمة المعاملة <span style="color:red;">*</span></label>
                            <input
                                disabled
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
                                $('#ID_NO').val(res.customer[0].ID_NO);
                                $('#phone_NO').val(res.customer[0].phone_NO);
                                $('#region').val(res.customer[0].region);
                                $('#address').val(res.customer[0].address);
                                $('#account').val(res.customer[0].account);
                                $('#transactions_type').val(res.customer[0].transactions[0].transactions_type);
                                $('#transaction_amount').val(res.customer[0].transactions[0].transaction_amount);
                                $('#first_payment').val(res.customer[0].transactions[0].first_payment);
                                $('#transaction_rest').val(res.customer[0].transactions[0].transaction_rest);
                                $('#monthly_payment').val(res.customer[0].transactions[0].monthly_payment);
                                $('#date_of_first_payment').val(res.customer[0].transactions[0].date_of_first_payment);
                            }
                        },
                    });
                });
            });
        });
    </script>

@endsection

