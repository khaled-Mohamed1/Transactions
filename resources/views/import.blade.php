@extends('layouts.app')

@section('title', 'اضافة نموذج')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-right">اضافة نموذج</h1>
            <a href="{{route('home')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary ">اضافة نموذج</h6>
            </div>
            <form method="POST" action="{{route('storeImport')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        <div class="col-md-12 mb-3 mt-3">
                            <p>يرجى اضافة النموذج بالحقل الذي بالأسفل</p>
                        </div>

                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>اسم النموذج <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}">

                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- File Input --}}
                        <div class="col-sm-9 mb-3 mt-3 mb-sm-0">
                            <label>ادخال النموذج <span style="color:red;">*</span></label>
                            <input
                                type="file"
                                class="form-control form-control-user @error('file') is-invalid @enderror"
                                id="exampleFile"
                                name="file"
                                value="{{ old('file') }}">

                            @error('file')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">اضافة</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('home') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>


@endsection
