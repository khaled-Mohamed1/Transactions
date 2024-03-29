@extends('layouts.app')

@section('title', 'اضافة صنف')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">اضافة صنف</h1>
            <a href="{{route('stores.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">اضافة صنف جديد</h6>
            </div>
            <form method="POST" action="{{route('stores.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- agent_name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>اسم الصنف <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user customer_qty @error('product_name') is-invalid @enderror"
                                id="product_name"
                                name="product_name"
                                value="{{ old('product_name') }}">

                            @error('product_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>الكمية <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user customer_qty @error('product_qty') is-invalid @enderror"
                                id="product_qty"
                                name="product_qty"
                                min="1"
                                value="{{ old('product_qty') }}">

                            @error('product_qty')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>السعر كامل <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user customer_qty @error('product_price') is-invalid @enderror"
                                id="product_price"
                                name="product_price"
                                value="{{ old('product_price') }}">

                            @error('product_price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>نسبة الربح <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user customer_qty @error('profit_ratio') is-invalid @enderror"
                                id="profit_ratio"
                                name="profit_ratio"
                                value="{{ old('profit_ratio') }}">

                            @error('profit_ratio')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">اضافة</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('stores.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection
