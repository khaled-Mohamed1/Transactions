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
                                <option value="غزة" {{ $customer->region == 'غزة' ? 'selected' : ''}}>غزة</option>
                                <option value="خانيونس" {{ $customer->region == 'خانيونس' ? 'selected' : ''}}>خانيونس</option>
                                <option value="غزة" {{ $customer->region == 'رفح' ? 'selected' : ''}}>رفح</option>
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
                            <label>الحالة <span style="color:red;">*</span></label>
                            <select name="status" class="form-control form-control-user @error('status') is-invalid @enderror">
                                @if($customer->status == 'مكتمل')
                                    <option value="{{$customer->status}}">{{$customer->status}}</option>
                                @else
                                @endif
                                <option value="جديد" {{$customer->status == 'جديد' ? 'selected' : ''}}>جديد</option>
                                <option value="مقبول" {{ $customer->status == 'مقبول' ? 'selected' : ''}}>مقبول</option>
                                <option value="مرفوض" {{ $customer->status == 'مرفوض' ? 'selected' : ''}}>مرفوض</option>
                            </select>

                            @error('status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- Account --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>الحساب <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('account') is-invalid @enderror"
                                id="exampleaccount"
                                name="account"
                                value="{{ old('account') ? old('account') : $customer->account}}">

                            @error('account')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

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
