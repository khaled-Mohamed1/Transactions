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
            <form method="POST" action="{{route('customers.store')}}">
                @csrf
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
                                value="{{ old('full_name') }}">

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
                                value="{{ old('ID_NO') }}">

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
                                id="phone_NO"
                                name="phone_NO"
                                value="{{ old('phone_NO') }}">

                            @error('phone_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- region --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>المنطقة <span style="color:red;">*</span></label>
                            <select name="region" class="form-control form-control-user @error('region') is-invalid @enderror">
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
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>العنوان كامل <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('address') is-invalid @enderror"
                                id="exampleaddress"
                                name="address"
                                value="{{ old('address') }}">

                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
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

