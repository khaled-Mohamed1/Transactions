@extends('layouts.app')

@section('title', 'اضافة قضية')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">اضافة قضية</h1>
            <a href="{{route('issues.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">اضافة قضية جديد</h6>
            </div>
            <form method="POST" action="{{route('issues.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- court_name --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم المحكمة <span style="color:red;">*</span></label>
                            <select name="court_name" class="form-control form-control-user @error('court_name') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="بداية الشمال" {{ old('court_name') == 'بداية الشمال' ? 'selected' : '' }}>بداية الشمال</option>
                                <option value="بداية غزة" {{ old('court_name') == 'بداية غزة' ? 'selected' : '' }}>بداية غزة</option>
                                <option value="بداية دير البلح" {{ old('court_name') == 'بداية دير البلح' ? 'selected' : '' }}>بداية دير البلح</option>
                                <option value="بداية خانيونس" {{ old('court_name') == 'بداية خانيونس' ? 'selected' : '' }}>بداية خانيونس</option>
                                <option value="بداية رفح" {{ old('court_name') == 'بداية رفح' ? 'selected' : '' }}>بداية رفح</option>
                            </select>
{{--                            <input--}}
{{--                                type="text"--}}
{{--                                class="form-control form-control-user customer_qty @error('court_name') is-invalid @enderror"--}}
{{--                                id="court_name"--}}
{{--                                name="court_name"--}}
{{--                                value="{{ old('court_name') }}">--}}
                            @error('court_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        {{-- case_number --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم القضية <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user customer_qty @error('case_number') is-invalid @enderror"
                                id="case_number"
                                name="case_number"
                                value="{{ old('case_number') }}">

                            @error('case_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- case_amount --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>مبلغ القضية <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('case_amount') is-invalid @enderror"
                                id="case_amount"
                                name="case_amount"
                                value="{{ old('case_amount') }}">

                            @error('case_amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- execution_request --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>طالب التنفيذ <span style="color:red;">*</span></label>
                            <select name="execution_request" class="form-control form-control-user @error('execution_request') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                @foreach($agents->where('agent_type','طالب التنفيذ') as $agent)
                                    <option value="{{$agent->id}}">{{$agent->agent_name}}</option>
                                @endforeach
                            </select>

                            @error('execution_request')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- agent_name --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>وكيل طالب التنفيذ </label>

                            <select name="execution_agent_name" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                @foreach($agents->where('agent_type','وكيل طالب التنفيذ') as $agent)
                                    <option value="{{$agent->id}}">{{$agent->agent_name}}</option>
                                @endforeach
                            </select>

                        </div>

                        {{-- agent_name --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>وكيل المنفذ ضده </label>
                            <select name="execution_agent_against_it" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                @foreach($agents->where('agent_type','وكيل المنفذ ضده') as $agent)
                                    <option value="{{$agent->id}}">{{$agent->agent_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- customer_qty --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>عدد الأطراف <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user customer_qty @error('customer_qty') is-invalid @enderror"
                                id="customer_qty"
                                name="customer_qty"
                                min="1"
                                max="6"
                                value="{{ old('customer_qty') }}">

                            @error('customer_qty')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- notes --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>ملاحظات </label>
                            <input
                                type="text"
                                class="form-control form-control-user"
                                id="notes"
                                name="notes"
                                value="{{ old('notes') }}">
                        </div>

                        <div id="display" class="form-group row col-12">

                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">اضافة</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('issues.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $("#customer_qty").change(function(){

                if($(this).val() >= 7 || $(this).val() <= 0){
                    $(this).val(6)
                }

                $('#display').empty();

                for (let i = 1; i <= $(this).val(); i++){
                    $("#display").append(
                        `
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user"
                                id="customer_id"
                                name="customer_id[]">

                        </div>`

                    );
                }
            });


        });
    </script>

@endsection
