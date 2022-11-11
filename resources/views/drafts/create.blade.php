@extends('layouts.app')

@section('title', 'اضافة مستند')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">اضافة مستند</h1>
            <a href="{{route('drafts.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">اضافة مستند جديد</h6>
            </div>
            <form method="POST" action="{{route('drafts.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- document_type --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>نوع المستند <span style="color:red;">*</span></label>
                            <select name="document_type" class="form-control form-control-user @error('document_type') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="كمبيالة" {{ old('document_type') == 'كمبيالة' ? 'selected' : '' }}>كمبيالة</option>
                            </select>

                            @error('document_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        {{-- customer_qty --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>عدد الأفراد <span style="color:red;">*</span></label>
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

                        {{-- document_qty --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>عدد المستندات <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('document_qty') is-invalid @enderror"
                                id="document_qty"
                                name="document_qty"
                                min="0"
                                value="{{ old('document_qty') }}">

                            @error('document_qty')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- document_affiliate --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>عدد المستندات التابعة <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('document_affiliate') is-invalid @enderror"
                                id="document_affiliate"
                                name="document_affiliate"
                                min="0"
                                value="{{ old('document_affiliate') }}">

                            @error('document_affiliate')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div id="display" class="form-group row col-12">

                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">اضافة</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('drafts.index') }}">إلغاء</a>
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
