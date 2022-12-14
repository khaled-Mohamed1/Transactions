@extends('layouts.app')

@section('title', 'تعديل الوكيل')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">تعديل الوكيل</h1>
            <a href="{{route('agents.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">تعديل الوكيل</h6>
            </div>
            <form method="POST" action="{{route('agents.update', ['agent' => $agent->id])}}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group row">


                        <input
                            type="hidden"
                            class="form-control form-control-user"
                            id="agent_id"
                            name="agent_id"
                            value="{{$agent->id}}">


                        {{-- agent_name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>اسم الوكيل <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user customer_qty @error('agent_name') is-invalid @enderror"
                                id="agent_name"
                                name="agent_name"
                                value="{{ $agent->agent_name }}">

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
                                value="{{ $agent->ID_NO }}">

                            @error('ID_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>العنوان <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user customer_qty @error('address') is-invalid @enderror"
                                id="address"
                                name="address"
                                value="{{ $agent->address }}">

                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- agent_type --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>نوع الوكيل <span style="color:red;">*</span></label>
                            <select name="agent_type" class="form-control form-control-user @error('agent_type') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="طالب التنفيذ" {{old('agent_type') ? ((old('agent_type') == 'طالب التنفيذ') ? 'selected' : '') : (($agent->agent_type == 'طالب التنفيذ') ? 'selected' : '')}}>طالب التنفيذ</option>
                                <option value="وكيل طالب التنفيذ" {{old('agent_type') ? ((old('agent_type') == 'وكيل طالب التنفيذ') ? 'selected' : '') : (($agent->agent_type == 'وكيل طالب التنفيذ') ? 'selected' : '')}}>وكيل طالب التنفيذ</option>
                                <option value="وكيل المنفذ ضده" {{old('agent_type') ? ((old('agent_type') == 'وكيل المنفذ ضده') ? 'selected' : '') : (($agent->agent_type == 'وكيل المنفذ ضده') ? 'selected' : '')}}>وكيل المنفذ ضده</option>
                                <option value="المحول له" {{old('agent_type') ? ((old('agent_type') == 'المحول له') ? 'selected' : '') : (($agent->agent_type == 'المحول له') ? 'selected' : '')}}>المحول له</option>
                            </select>
                            @error('agent_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_qty --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>عدد البنوك </label>
                            <input
                                type="number"
                                class="form-control form-control-user customer_qty"
                                id="bank_qty"
                                name="bank_qty"
                                min="1"
                                max="10"
                                value="{{ old('bank_qty') }}">
                        </div>

                        <div id="display" class="form-group row col-12">

                        </div>


                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">تعديل</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('agents.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            let array = @json($banks);
            console.log(array)
            $("#bank_qty").val(array.length)
            for (let i = 0; i < array.length; i++){
                $("#display").append(
                    `
<div class="row m-auto">
<div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك</label>
                            <select name="bank_name[]" class="form-control form-control-user" style="height: 45px">
                                <option disabled >اختر...</option>
                                @foreach($banks_admin as $bank)
                                    <option value="{{$bank->id}}" ${array[i].bank_id === {{$bank->id}} ? 'selected' : ''}>{{$bank->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>فرع البنك</label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user"
                                id="bank_branch"
                                name="bank_branch[]"
                                value="${array[i].bank_branch}">

                        </div>
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم حساب البنك</label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user"
                                id="bank_account_NO[]"
                                name="bank_account_NO[]"
                                value="${array[i].bank_account_NO}">

                        </div>
</div>
`

                );
            }

            $("#bank_qty").change(function(index){

                if($(this).val() >= 13 || $(this).val() <= 0){
                    $(this).val(12)
                }

                console.log(array.length)
                console.log($(this).val())

                $('#display').empty(index);

                let test = array.length
                if($(this).val() < array.length){
                    test = $(this).val();
                }else{
                    test = array.length
                }

                for (let i = 0; i < test; i++){
                    $("#display").append(
                        `
<div class="row m-auto">
<div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك</label>
                            <select name="bank_name[]" class="form-control form-control-user" style="height: 45px">
                                <option disabled >اختر...</option>
                                <option value="بنك فلسطين"${array[i].bank_name == "بنك فلسطين" ? 'selected' : ''}>بنك فلسطين</option>
                                <option value="بنك القدس" ${array[i].bank_name == "بنك القدس" ? 'selected' : ''}>بنك القدس</option>
                                <option value="البنك الإسلامي الفلسطيني" ${array[i].bank_name == "بنك الإسلامي الفلسطيني" ? 'selected' : ''}>البنك الإسلامي الفلسطيني</option>
                                <option value="البنك العقاري المصري العربي" ${array[i].bank_name == "البنك العقاري المصري العربي" ? 'selected' : ''}>البنك العقاري المصري العربي</option>
                                <option value="بنك الوطني الاسلامي"${array[i].bank_name == "بنك الوطني الاسلامي" ? 'selected' : ''} >بنك الوطني الاسلامي</option>
                                <option value="بنك الانتاج الفلسطيني"${array[i].bank_name == "بنك الانتاج الفلسطيني" ? 'selected' : ''} >بنك الانتاج الفلسطيني</option>
                                <option value="بنك الأردن"${array[i].bank_name == "بنك الأردن" ? 'selected' : ''}>بنك الأردن</option>
                                <option value="بنك القاهرة عمان"${array[i].bank_name == "بنك القاهرة عمان" ? 'selected' : ''} >بنك القاهرة عمان</option>
                                <option value="بنك الاستثمار الفلسطيني"${array[i].bank_name == "بنك الاستثمار الفلسطيني" ? 'selected' : ''} >بنك الاستثمار الفلسطيني</option>
                                <option value="البنك العربي"${array[i].bank_name == "البنك العربي" ? 'selected' : ''} >البنك العربي</option>
                                <option value="البنك الاسلامي العربي"${array[i].bank_name == "البنك الاسلامي العربي" ? 'selected' : ''} >البنك الاسلامي العربي</option>
                                <option value="بنك الاسكان للتجارة والتمويل"${array[i].bank_name == "بنك الاسكان للتجارة والتمويل" ? 'selected' : ''} >بنك الاسكان للتجارة والتمويل</option>
                                <option value="البنك التجاري الأردني"${array[i].bank_name == "البنك التجاري الأردني" ? 'selected' : ''} >البنك التجاري الأردني</option>
                                <option value="البنك الأهلي الأردني"${array[i].bank_name == "البنك الأهلي الأردني" ? 'selected' : ''} >البنك الأهلي الأردني</option>
                                <option value="البنك الوطني"${array[i].bank_name == "البنك الوطني" ? 'selected' : ''} >البنك الوطني</option>
                                <option value="البريد"${array[i].bank_name == "البريد" ? 'selected' : ''}>البريد</option>
                            </select>
                        </div>

                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>فرع البنك</label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user"
                                id="bank_branch"
                                name="bank_branch[]"
                                value="${array[i].bank_branch}">

                        </div>
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم حساب البنك</label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user"
                                id="bank_account_NO[]"
                                name="bank_account_NO[]"
                                value="${array[i].bank_account_NO}">

                        </div>
</div>
`

                    );
                }

                for (let i = 0; i < $(this).val() - array.length; i++){
                    $("#display").append(
                        `
<div class="row m-auto">
<div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك</label>
                            <select name="bank_name[]" class="form-control form-control-user" style="height: 45px">
                                <option disabled >اختر...</option>
                                <option value="بنك فلسطين">بنك فلسطين</option>
                                <option value="بنك القدس">بنك القدس</option>
                                <option value="البنك الإسلامي الفلسطيني">البنك الإسلامي الفلسطيني</option>
                                <option value="البنك العقاري المصري العربي">البنك العقاري المصري العربي</option>
                                <option value="بنك الوطني الاسلامي" >بنك الوطني الاسلامي</option>
                                <option value="بنك الانتاج الفلسطيني" >بنك الانتاج الفلسطيني</option>
                                <option value="بنك الأردن">بنك الأردن</option>
                                <option value="بنك القاهرة عمان" >بنك القاهرة عمان</option>
                                <option value="بنك الاستثمار الفلسطيني" >بنك الاستثمار الفلسطيني</option>
                                <option value="البنك العربي" >البنك العربي</option>
                                <option value="البنك الاسلامي العربي" >البنك الاسلامي العربي</option>
                                <option value="بنك الاسكان للتجارة والتمويل" >بنك الاسكان للتجارة والتمويل</option>
                                <option value="البنك التجاري الأردني" >البنك التجاري الأردني</option>
                                <option value="البنك الأهلي الأردني" >البنك الأهلي الأردني</option>
                                <option value="البنك الوطني" >البنك الوطني</option>
                                <option value="البريد">البريد</option>
                            </select>
                        </div>

                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>فرع البنك</label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user"
                                id="bank_branch"
                                name="bank_branch[]">

                        </div>
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم حساب البنك</label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user"
                                id="bank_account_NO[]"
                                name="bank_account_NO[]">

                        </div>
</div>

`

                    );
                }
            });


        });
    </script>

@endsection
