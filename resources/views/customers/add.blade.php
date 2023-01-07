@extends('layouts.app')

@section('title', 'اضافة عميل')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">اضافة عميل</h1>
            <a href="{{route('customers.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">اضافة عميل جديد</h6>
            </div>
            <form method="POST" action="{{route('customers.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- full_name --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الإسم كامل <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user @error('full_name') is-invalid @enderror"
                                id="exampleFull_Name"
                                name="full_name"
                                value="{{ old('full_name') }}">

                            @error('full_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user @error('ID_NO') is-invalid @enderror"
                                id="exampleID_NO"
                                name="ID_NO"
                                value="{{ old('ID_NO') }}">

                            @error('ID_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الجوال <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user @error('phone_NO') is-invalid @enderror"
                                id="phone_NO"
                                name="phone_NO"
                                value="{{ old('phone_NO') }}">

                            @error('phone_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- region --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>المنطقة <span style="color:red;">*</span></label>
                            <select style="height: 45px;" name="region" class="form-control form-control-user @error('region') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="الشمال" {{ old('region') == 'الشمال' ? 'selected' : '' }}>الشمال</option>
                                <option value="غزة" {{ old('region') == 'غزة' ? 'selected' : '' }}>غزة</option>
                                <option value="وسطى" {{ old('region') == 'وسطى' ? 'selected' : '' }}>الوسطى</option>
                                <option value="خانيونس" {{ old('region') == 'خانيونس' ? 'selected' : '' }}>خانيونس</option>
                                <option value="رفح" {{ old('region') == 'رفح' ? 'selected' : '' }}>رفح</option>
                            </select>

                            @error('region')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>العنوان كامل <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user @error('address') is-invalid @enderror"
                                id="exampleaddress"
                                name="address"
                                value="{{ old('address') }}">

                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- reserve_phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم البديل </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user"
                                id="reserve_phone_NO"
                                name="reserve_phone_NO"
                                value="{{ old('reserve_phone_NO') }}">

                        </div>

                        {{-- date_of_birth --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>تاريخ الميلاد <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px;"
                                type="date"
                                class="form-control form-control-user @error('date_of_birth') is-invalid @enderror"
                                id="date_of_birth"
                                name="date_of_birth"
                                value="{{ old('date_of_birth') }}">

                            @error('date_of_birth')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- marital_status --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الحالة الإجتماعية <span style="color:red;">*</span></label>
                            <select style="height: 45px;" name="marital_status" class="form-control form-control-user @error('marital_status') is-invalid @enderror">
                                <option disabled {{ old('marital_status') == null ? 'selected' : '' }}>اختر...</option>
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
                                style="height: 45px;"
                                type="number"
                                class="form-control form-control-user @error('number_of_children') is-invalid @enderror"
                                id="number_of_children"
                                name="number_of_children"
                                min="0"
                                value="{{ old('number_of_children') }}">

                            @error('number_of_children')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- job --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الوظيفة <span style="color:red;">*</span></label>
                            <select style="height: 45px;" name="job" class="form-control form-control-user @error('job') is-invalid @enderror">
                                <option disabled selected>اختر...</option>
                                @foreach($jobs as $job)
                                    <option value="{{$job->id}}" {{ old('job') == $job->name ? 'selected' : '' }}>{{$job->name}}</option>
                                @endforeach
                            </select>

                            @error('job')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- salary --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الدخل <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px;"
                                type="number"
                                class="form-control form-control-user @error('salary') is-invalid @enderror"
                                id="salary"
                                name="salary"
                                min="0"
                                value="{{ old('salary')  }}">

                            @error('salary')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_name --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك </label>
                            <select style="height: 45px;" name="bank_name" class="form-control form-control-user @error('bank_name') is-invalid @enderror">
                                <option disabled {{ old('bank_name') == null ? 'selected' : '' }}>اختر...</option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}" {{ old('bank_name') == $bank->name ? 'selected' : '' }}>{{$bank->name}}</option>
                                @endforeach
                            </select>

                            @error('bank_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_branch --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>فرع البنك </label>
                            <input
                                style="height: 45px;"
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
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>رقم حساب البنك </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user @error('bank_account_NO') is-invalid @enderror"
                                id="bank_account_NO"
                                name="bank_account_NO"
                                value="{{ old('bank_account_NO') }}">

                            @error('bank_account_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- attachments --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>ادخال مرفقات</label>
                            <input
                                style="height: 45px;"
                                type="file"
                                class="form-control form-control-user @error('file') is-invalid @enderror"
                                id="File"
                                name="files[]" multiple
                                value="{{ old('file') }}">
                        </div>

                        {{-- notes --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>الملاحظات </label>
                            <textarea class="form-control form-control-user"
                                      name="notes" rows="3"></textarea>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">اضافة</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('customers.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection

