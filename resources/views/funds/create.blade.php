@extends('layouts.app')

@section('title', 'اضافة إلى الصندوق')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">اضافة مبلغ</h1>
            <a href="{{route('funds.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">اضافة مبلغ</h6>
            </div>
            <form method="POST" action="{{route('funds.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        <input
                            style="height: 45px;"
                            type="hidden"
                            name="fund_id"
                            value="{{ $fund->id }}">

                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>المبلغ القديم </label>
                            <input
                                style="height: 45px;"
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                value="{{ $fund->financial }}">
                        </div>

                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>المبلغ المضاف <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user customer_qty @error('financial') is-invalid @enderror"
                                id="financial"
                                name="financial"
                                value="{{ old('financial') }}">

                            @error('financial')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">اضافة</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('funds.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection


