@extends('layouts.app')

@section('title', 'اضافة وكيل')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">اضافة وكيل</h1>
            <a href="{{route('agents.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">اضافة وكيل جديد</h6>
            </div>
            <form method="POST" action="{{route('agents.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- agent_name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>اسم الوكيل <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user customer_qty @error('agent_name') is-invalid @enderror"
                                id="agent_name"
                                name="agent_name"
                                value="{{ old('agent_name') }}">

                            @error('agent_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user customer_qty @error('ID_NO') is-invalid @enderror"
                                id="ID_NO"
                                name="ID_NO"
                                value="{{ old('ID_NO') }}">

                            @error('ID_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>العنوان <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user customer_qty @error('address') is-invalid @enderror"
                                id="address"
                                name="address"
                                value="{{ old('address') }}">

                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- agent_type --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>نوع الوكيل <span style="color:red;">*</span></label>
                            <select name="agent_type" class="form-control form-control-user @error('agent_type') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="طالب التنفيذ" {{ old('agent_type') == 'طالب التنفيذ' ? 'selected' : '' }}>طالب التنفيذ</option>
                                <option value="وكيل طالب التنفيذ" {{ old('agent_type') == 'وكيل طالب التنفيذ' ? 'selected' : '' }}>وكيل طالب التنفيذ</option>
                                <option value="وكيل المنفذ ضده" {{ old('agent_type') == 'وكيل المنفذ ضده' ? 'selected' : '' }}>وكيل المنفذ ضده</option>
                            </select>
                            @error('agent_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>



                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">اضافة</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('agents.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection
