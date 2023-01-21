@extends('layouts.app')

@section('title', 'بحث شامل')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">نوع البحث</h1>
            <div>
                <button type="button" class="btn btn-primary mr-2" id="button_search_customer">بحث عن عملاء</button>
                <button type="button" class="btn btn-primary mr-2" id="button_search_transaction">بحث عن معاملات</button>
                <button type="button" class="btn btn-primary mr-2" id="button_search_draft">بحث عن كمبيالات</button>
                <button type="button" class="btn btn-primary mr-2" id="button_search_issue">بحث عن قضيايا</button>
            </div>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right" id="search_form_customer" style="display: none">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">بحث عن عملاء</h6>
            </div>
            <form method="GET" action="{{route('searches.search')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        <input
                            style="height: 45px;"
                            type="hidden"
                            class="form-control form-control-user"
                            name="type"
                        value="customer">

                        {{-- customer_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الاستدلالي </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user"
                                id="customer_NO"
                                name="customer_NO">
                        </div>

                        {{-- full_name --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الإسم كامل </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user"
                                id="full_name"
                                name="full_name">
                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user"
                                id="ID_NO"
                                name="ID_NO">
                        </div>

                        {{-- phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الجوال </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user"
                                id="phone_NO"
                                name="phone_NO">
                        </div>

                        {{-- region --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>المنطقة </label>
                            <select style="height: 45px;" name="region" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                <option value="الشمال">الشمال</option>
                                <option value="غزة">غزة</option>
                                <option value="وسطى">الوسطى</option>
                                <option value="خانيونس">خانيونس</option>
                                <option value="رفح">رفح</option>
                            </select>
                        </div>

                        {{-- marital_status --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الحالة الإجتماعية </label>
                            <select name="marital_status" style="height: 45px"
                                    class="form-control form-control-user">
                                <option disabled selected>اختر...</option>
                                <option value="اعزب">اعزب</option>
                                <option value="متزوج">متزوج</option>
                                <option value="مطلق" >مطلق</option>
                            </select>
                        </div>

                        {{-- job_id --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الوظيفة </label>
                            <select name="job_id" style="height: 45px"
                                    class="form-control form-control-user">
                                <option disabled selected>اختر...</option>
                                @foreach($jobs as $job)
                                    <option value="{{$job->id}}">{{$job->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        {{-- bank_id --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك </label>
                            <select name="bank_id" style="height: 45px"
                                    class="form-control form-control-user">
                                <option disabled selected>اختر...</option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- status --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>حالة العميل </label>
                            <select name="status" style="height: 45px"
                                    class="form-control form-control-user">
                                <option disabled selected>اختر...</option>
                                <option value="جديد">جديد</option>
                                <option value="مقبول">مقبول</option>
                                <option value="مكتمل" >مكتمل</option>
                                <option value="ملتزم" >ملتزم</option>
                                <option value="مرفوض" >مرفوض</option>
                                <option value="متعسر" >متعسر</option>
                                <option value="قيد التوقيع" >قيد التوقيع</option>
                                <option value="قيد العمل" >قيد العمل</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">بحث</button>
                </div>
            </form>
        </div>

        <div class="card shadow mb-4 text-right" id="search_form_transaction" style="display: none">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">بحث عن المعاملات</h6>
            </div>
            <form method="GET" action="{{route('searches.search')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        <input
                            style="height: 45px;"
                            type="hidden"
                            class="form-control form-control-user"
                            name="type"
                            value="transaction">

                        {{-- transaction_NO --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>رقم الاستدلالي </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user"
                                id="transaction_NO"
                                name="transaction_NO">
                        </div>

                        {{-- transactions_type --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>نوع المعاملة </label>
                            <select name="transactions_type" style="height: 45px"
                                    class="form-control form-control-user">
                                <option  disabled selected>اختر...</option>
                                <option value="ودي">ودي</option>
                                <option value="استقطاع">استقطاع</option>
                                <option value="شيكات">شيكات</option>
                                <option value="قروض">قروض</option>
                            </select>

                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">بحث</button>
                </div>
            </form>
        </div>

        <div class="card shadow mb-4 text-right" id="search_form_draft" style="display: none">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">بحث عن الكمبيالات</h6>
            </div>
            <form method="GET" action="{{route('searches.search')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        <input
                            style="height: 45px;"
                            type="hidden"
                            class="form-control form-control-user"
                            name="type"
                            value="draft">

                        {{-- draft_NO --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>رقم الاستدلالي </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user"
                                id="draft_NO"
                                name="draft_NO">
                        </div>

                        {{-- document_type --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>نوع الكمبيالة </label>
                            <select name="document_type" style="height: 45px"
                                    class="form-control form-control-user">
                                <option  disabled selected>اختر...</option>
                                <option value="كمبيالة">كمبيالة</option>
                            </select>

                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">بحث</button>
                </div>
            </form>
        </div>

        <div class="card shadow mb-4 text-right" id="search_form_issue" style="display: none">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">بحث عن قضايا</h6>
            </div>
            <form method="GET" action="{{route('searches.search')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        <input
                            style="height: 45px;"
                            type="hidden"
                            class="form-control form-control-user"
                            name="type"
                            value="issue">

                        {{-- issue_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الاستدلالي </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user"
                                id="issue_NO"
                                name="issue_NO">
                        </div>

                        {{-- court_name --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم المحكمة </label>
                            <select name="court_name" style="height: 45px;" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                <option value="بداية الشمال">بداية الشمال</option>
                                <option value="بداية غزة">بداية غزة</option>
                                <option value="بداية دير البلح">بداية دير البلح</option>
                                <option value="بداية خانيونس">بداية خانيونس</option>
                                <option value="بداية رفح">بداية رفح</option>
                            </select>
                        </div>

                        {{-- case_number --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم القضية </label>
                            <input
                                style="height: 45px;"
                                type="text"
                                class="form-control form-control-user"
                                id="case_number"
                                name="case_number">
                        </div>

                        {{-- document_type --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>نوع الكمبيالة </label>
                            <select name="document_type" style="height: 45px"
                                    class="form-control form-control-user">
                                <option  disabled selected>اختر...</option>
                                <option value="كمبيالة">كمبيالة</option>
                            </select>
                        </div>

                        {{-- execution_request --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>طالب التنفيذ </label>
                            <select name="execution_request" style="height: 45px;" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                @foreach($agents->where('agent_type','طالب التنفيذ') as $agent)
                                    <option value="{{$agent->id}}">{{$agent->agent_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- agent_name --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>وكيل طالب التنفيذ </label>

                            <select name="execution_agent_name" style="height: 45px;" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                @foreach($agents->where('agent_type','وكيل طالب التنفيذ') as $agent)
                                    <option value="{{$agent->id}}">{{$agent->agent_name}}</option>
                                @endforeach
                            </select>

                        </div>

                        {{-- agent_name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>وكيل المنفذ ضده </label>
                            <select name="execution_agent_against_it" style="height: 45px;" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                @foreach($agents->where('agent_type','وكيل المنفذ ضده') as $agent)
                                    <option value="{{$agent->id}}">{{$agent->agent_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- document_type --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>نوع السند </label>
                            <select name="bond_type" style="height: 45px;" class="form-control form-control-user">
                                <option selected disabled value="">اختار...</option>
                                <option value="كمبيالة">كمبيالة</option>
                                <option value="سند دين">سند دين</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">بحث</button>
                </div>
            </form>
        </div>
    </div>

@endsection


@section('scripts')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            //search button
            $(document).on('click', '#button_search_customer', function(e) {
                e.preventDefault();
                $("#search_form_customer").toggle();
                $("#search_form_transaction").hide();
                $("#search_form_draft").hide();
                $("#search_form_issue").hide();
            });

            $(document).on('click', '#button_search_transaction', function(e) {
                e.preventDefault();
                $("#search_form_transaction").toggle();
                $("#search_form_customer").hide();
                $("#search_form_draft").hide();
                $("#search_form_issue").hide();
            });

            $(document).on('click', '#button_search_draft', function(e) {
                e.preventDefault();
                $("#search_form_draft").toggle();
                $("#search_form_transaction").hide();
                $("#search_form_customer").hide();
                $("#search_form_issue").hide();
            });

            $(document).on('click', '#button_search_issue', function(e) {
                e.preventDefault();
                $("#search_form_issue").toggle();
                $("#search_form_transaction").hide();
                $("#search_form_draft").hide();
                $("#search_form_customer").hide();
            });


        });

    </script>

@endsection
