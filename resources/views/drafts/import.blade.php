@extends('layouts.app')

@section('title', 'استيراد بيانات')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-right">استيراد بيانات</h1>
            <a href="{{route('drafts.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary ">استيراد بيانات</h6>
            </div>
            <form method="POST" action="{{route('drafts.upload')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        <div class="col-md-12 mb-3 mt-3">
{{--                            <p>يرجى تحميل CSV بتنسيق معين <a href="{{ asset('files/sample-data-sheet.csv') }}" target="_blank">مثال لملف الإكسل</a></p>--}}
                        </div>
                        {{-- File Input --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label><span style="color:red;">*</span>ادخال الملف</label>
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
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">استيراد</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('drafts.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>


@endsection
