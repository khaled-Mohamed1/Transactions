@extends('layouts.app')

@section('title', 'تعديل قضية')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">تعديل قضية</h1>
            <a href="{{route('issues.show',['issue'=>$issue->id])}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">تعديل قضية جديد</h6>
            </div>
            <form method="POST" action="{{route('issues.update',['issue' => $issue->id])}}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">

                        <input
                            type="hidden"
                            class="form-control form-control-user"
                            id="issue_id"
                            name="issue_id"
                            value="{{$issue->id}}">

                        {{-- court_name --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>اسم المحكمة <span style="color:red;">*</span></label>
                            <select name="court_name" style="height: 45px;" style="height: 45px" class="form-control form-control-user @error('court_name') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="بداية الشمال" {{ $issue->court_name == 'بداية الشمال' ? 'selected' : '' }}>بداية الشمال</option>
                                <option value="بداية غزة" {{ $issue->court_name == 'بداية غزة' ? 'selected' : '' }}>بداية غزة</option>
                                <option value="بداية دير البلح" {{ $issue->court_name == 'بداية دير البلح' ? 'selected' : '' }}>بداية دير البلح</option>
                                <option value="بداية خانيونس" {{ $issue->court_name == 'بداية خانيونس' ? 'selected' : '' }}>بداية خانيونس</option>
                                <option value="بداية رفح" {{ $issue->court_name == 'بداية رفح' ? 'selected' : '' }}>بداية رفح</option>
                            </select>
                            @error('court_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        {{-- case_number --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>رقم القضية </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user customer_qty"
                                id="case_number"
                                name="case_number"
                                value="{{ $issue->case_number }}">
                        </div>

                        {{-- case_amount --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>مبلغ القضية <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px;"
                                type="number"
                                class="form-control form-control-user @error('case_amount') is-invalid @enderror"
                                id="case_amount"
                                name="case_amount"
                                value="{{ $issue->case_amount }}">

                            @error('case_amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>نوع العملة <span style="color:red;">*</span></label>
                            <select name="currency_type" style="height: 45px;" class="form-control form-control-user @error('currency_type') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="شيكل" {{ $issue->currency_type == 'شيكل' ? 'selected' : '' }}>شيكل</option>
                                <option value="دولار" {{ $issue->currency_type == 'دولار' ? 'selected' : '' }}>دولار</option>
                                <option value="دينار" {{ $issue->currency_type == 'دينار' ? 'selected' : '' }}>دينار</option>
                            </select>

                            @error('currency_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        {{-- execution_request --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>طالب التنفيذ <span style="color:red;">*</span></label>
                            <select style="height: 45px" name="execution_request" style="height: 45px;" class="form-control form-control-user @error('execution_request') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                @foreach($agents->where('agent_type','طالب التنفيذ') as $agent)
                                    <option value="{{$agent->id}}" {{$issue->execution_request_idIssue->agent_name == $agent->agent_name ? 'selected' : ''}}>{{$agent->agent_name}}</option>
                                @endforeach
                            </select>

                            @error('execution_request')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- agent_name --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>وكيل طالب التنفيذ </label>

                            <select style="height: 45px" name="execution_agent_name" style="height: 45px;" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                @foreach($agents->where('agent_type','وكيل طالب التنفيذ') as $agent)
                                    <option value="{{$agent->id}}" {{$issue->execution_agent_name_idIssue->agent_name ?? '' == $agent->agent_name ? 'selected' : ''}}>{{$agent->agent_name}}</option>
                                @endforeach
                            </select>

                        </div>

                        {{-- agent_name --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>وكيل المنفذ ضده </label>
                            <select style="height: 45px" name="execution_agent_against_it" style="height: 45px;" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                @foreach($agents->where('agent_type','وكيل المنفذ ضده') as $agent)
                                    <option value="{{$agent->id}}" {{$issue->execution_agent_against_it_idIssue->agent_name ?? '' == $agent->agent_name ? 'selected' : ''}}>{{$agent->agent_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- customer_qty --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>عدد الأطراف <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px;"
                                style="height: 45px"
                                type="number"
                                class="form-control form-control-user customer_qty @error('customer_qty') is-invalid @enderror"
                                id="customer_qty"
                                name="customer_qty"
                                min="1"
                                max="12"
                                value="{{ $issue->customer_qty }}">

                            @error('customer_qty')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>نوع السند <span style="color:red;">*</span></label>
                            <select name="bond_type" style="height: 45px;" class="form-control form-control-user @error('bond_type') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="كمبيالة" {{ $issue->bond_type == 'كمبيالة' ? 'selected' : '' }}>كمبيالة</option>
                                <option value="سند دين" {{ $issue->bond_type == 'سند دين' ? 'selected' : '' }}>سند دين</option>
                            </select>

                            @error('bond_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- notes --}}
                        <div class="col-sm-10 mb-3 mt-3 mb-sm-0">
                            <label>ملاحظات </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user"
                                id="notes"
                                name="notes"
                                value="{{ $issue->notes }}">
                        </div>

                        <div id="display" class="form-group row col-12">

                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">تعديل</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('issues.show',['issue'=>$issue->id]) }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            let qty = $("#customer_qty").val();
            let array = @json($array);

            for (let i = 0; i < qty; i++){
                $("#display").append(
                    `
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user"
                                id="customer_id"
                                name="customer_id[]"
                                value="${array[i]}">

                        </div>
`

                );
            }

            $("#customer_qty").change(function(){

                if($(this).val() >=13 || $(this).val() <= 0){
                    $(this).val(12)
                }

                $('#display').empty();

                for (let i = 0; i < $(this).val(); i++){
                    $("#display").append(
                        `
                    <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user"
                                id="customer_id"
                                name="customer_id[]"
                                value="${array[i] ?? ''}">

                        </div>`

                    );
                }
            });


        });
    </script>

@endsection
