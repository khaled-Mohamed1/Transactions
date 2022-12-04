@extends('layouts.app')

@section('title', 'تعديل العميل')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">تعديل عميل</h1>
            <a href="{{route('customers.show',['customer' => $customer->id])}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
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
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الإسم كامل <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"

                                type="text"
                                class="form-control form-control-user @error('full_name') is-invalid @enderror"
                                id="full_name"
                                name="full_name"
                                value="{{ $customer->full_name }}">

                            @error('full_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"

                                type="text"
                                class="form-control form-control-user @error('ID_NO') is-invalid @enderror"
                                id="ID_NO"
                                name="ID_NO"
                                value="{{ $customer->ID_NO }}">

                            @error('ID_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الجوال <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"

                                type="text"
                                class="form-control form-control-user @error('phone_NO') is-invalid @enderror"
                                id="phone_NO"
                                name="phone_NO"
                                value="{{ $customer->phone_NO }}">

                            @error('phone_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- region --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>المنطقة <span style="color:red;">*</span></label>
                            <select                                 style="height: 45px"
                                                                    name="region" class="form-control form-control-user @error('region') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="الشمال" {{ $customer->region == 'الشمال' ? 'selected' : '' }}>الشمال</option>
                                <option value="غزة" {{ $customer->region == 'غزة' ? 'selected' : '' }}>غزة</option>
                                <option value="وسطى" {{ $customer->region == 'وسطى' ? 'selected' : '' }}>الوسطى</option>
                                <option value="خانيونس" {{ $customer->region == 'خانيونس' ? 'selected' : '' }}>خانيونس</option>
                                <option value="رفح" {{ $customer->region == 'رفح' ? 'selected' : '' }}>رفح</option>
                            </select>

                            @error('region')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>العنوان كامل <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"

                                type="text"
                                class="form-control form-control-user @error('address') is-invalid @enderror"
                                id="address"
                                name="address"
                                value="{{ $customer->address }}">

                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- reserve_phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم البديل </label>
                            <input
                                style="height: 45px"

                                type="text"
                                class="form-control form-control-user"
                                id="reserve_phone_NO"
                                name="reserve_phone_NO"
                                value="{{ $customer->reserve_phone_NO }}">

                        </div>

                        {{-- date_of_birth --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>تاريخ الميلاد <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"

                                type="date"
                                class="form-control form-control-user @error('date_of_birth') is-invalid @enderror"
                                id="date_of_birth"
                                name="date_of_birth"
                                value="{{ $customer->date_of_birth }}">

                            @error('date_of_birth')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- marital_status --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الحالة الإجتماعية <span style="color:red;">*</span></label>
                            <select name="marital_status"                                 style="height: 45px"
                                    class="form-control form-control-user @error('marital_status') is-invalid @enderror">
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
                                style="height: 45px"
                                type="number"
                                class="form-control form-control-user @error('number_of_children') is-invalid @enderror"
                                id="number_of_children"
                                name="number_of_children"
                                min="0"
                                value="{{ $customer->number_of_children }}">

                            @error('number_of_children')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- job --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الوظيفة <span style="color:red;">*</span></label>
                            <select name="job"                                 style="height: 45px"
                                    class="form-control form-control-user @error('job') is-invalid @enderror">
                                <option disabled selected>اختر...</option>
                                <option value="متقاعد عسكري رام الله" {{ $customer->job == 'متقاعد عسكري رام الله' ? 'selected' : '' }}>متقاعد عسكري رام الله</option>
                                <option value="موظف عسكري رام الله" {{ $customer->job == 'موظف عسكري رام الله' ? 'selected' : '' }}>موظف عسكري رام الله</option>
                                <option value="متقاعد مدني رام الله" {{ $customer->job == 'متقاعد مدني رام الله' ? 'selected' : '' }}>متقاعد مدني رام الله</option>
                                <option value="موظف مدني رام الله" {{ $customer->job == 'موظف مدني رام الله' ? 'selected' : '' }}>موظف مدني رام الله</option>
                                <option value="موظف عسكري غزة" {{ $customer->job == 'موظف عسكري غزة' ? 'selected' : '' }}>متقاعد مدني رام الله</option>
                                <option value="موظف مدني غزة" {{ $customer->job == 'موظف مدني غزة' ? 'selected' : '' }}>موظف مدني غزة</option>
                                <option value="متقاعد عسكري غزة" {{ $customer->job == 'متقاعد عسكري غزة' ? 'selected' : '' }}>متقاعد عسكري غزة</option>
                                <option value="متقاعد مدني غزة" {{ $customer->job == 'متقاعد مدني غزة' ? 'selected' : '' }}>متقاعد مدني غزة</option>
                                <option value="وكالة" {{ $customer->job == 'وكالة' ? 'selected' : '' }}>وكالة</option>
                                <option value="قطاع خاص" {{ $customer->job == 'قطاع خاص' ? 'selected' : '' }}>قطاع خاص</option>
                                <option value="بدون" {{ $customer->job == 'بدون' ? 'selected' : '' }}>بدون</option>

                            </select>

                            @error('job')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- salary --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الدخل <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"
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
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك <span style="color:red;">*</span></label>
                            <select name="bank_name"                                 style="height: 45px"
                                    class="form-control form-control-user @error('bank_name') is-invalid @enderror">
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
                            <label>فرع البنك <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"

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
                            <label>رقم حساب البنك <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user @error('bank_account_NO') is-invalid @enderror"
                                id="bank_account_NO"
                                name="bank_account_NO"
                                value="{{ $customer->bank_account_NO }}">

                            @error('bank_account_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- status --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>الحالة </label>
                            <select name="status" id="status" class="form-control form-control-user h-50"
                                    style="height: 45px">
                                @if($customer->status == 'قيد التوقيع' || $customer->status == 'متعسر' || $customer->status == 'مكتمل')
                                    <option value="{{$customer->status}}">{{$customer->status}}</option>
                                @endif

                                <option value="مقبول" {{old('status') ? ((old('status') == 'مقبول') ? 'selected' : '')
                                                        : (($customer->status == 'مقبول') ? 'selected' : '')}}>مقبول</option>
                                <option value="مرفوض" {{old('status') ? ((old('status') == 'مرفوض') ? 'selected' : '')
                                                        : (($customer->status == 'مرفوض') ? 'selected' : '')}}>مرفوض</option>
                            </select>

                        </div>

                        {{-- Account --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>الحساب </label>
                            <input
                                type="text"
                                class="form-control form-control-user h-50"
                                id="exampleaccount"
                                name="account"
                                value="{{ old('account') ? old('account') : $customer->account}}">
                        </div>

                        {{-- notes --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>الملاحظات </label>
                            <textarea class="form-control form-control-user"
                                      name="notes" rows="3">{{$customer->notes}}</textarea>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">تعديل</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('customers.show',['customer' => $customer->id]) }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection

{{--@section('scripts')--}}

{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function() {--}}

{{--            if ($("#status").val() === 'مقبول') {--}}
{{--                $("#display").show();--}}
{{--                console.log($('show',"#status").val())--}}
{{--            } else {--}}
{{--                $("#display").hide();--}}
{{--                console.log('hide',$("#status").val())--}}
{{--            }--}}

{{--            $("#status").on("change", function() {--}}
{{--                if ($(this).val() == 'مقبول') {--}}
{{--                    $("#display").show().siblings();--}}
{{--                } else {--}}
{{--                    $("#display").hide();--}}
{{--                }--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}

{{--@endsection--}}
