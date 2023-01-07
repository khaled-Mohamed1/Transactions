@extends('layouts.app')

@section('title', 'اضافة وظيفة')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">اضافة وظيفة</h1>
            <a href="{{route('jobs.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">اضافة وظيفة جديد</h6>
            </div>
            <form method="POST" action="{{route('jobs.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- job_name --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>اسم الوظيفة <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user customer_qty @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}">

                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">اضافة</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('jobs.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection
