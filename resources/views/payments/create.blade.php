@extends('layouts.app')

@section('title', 'اضافة دفعة')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">اضافة دفعة</h1>
            <a href="{{route('home')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">اضافة دفعة جديد</h6>
            </div>
            <form method="POST" action="{{route('payments.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- ID_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية <span style="color:red;">*</span></label>
                            <input
                                type="text"
                                class="form-control form-control-user @error('ID_NO') is-invalid @enderror"
                                id="ID_NO"
                                name="ID_NO"
                                value="{{ old('ID_NO') }}">

                            @error('ID_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الإسم رباعي </label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="full_name"
                                value="">
                        </div>

                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الجوال </label>
                            <input
                                disabled
                                type="text"
                                class="form-control form-control-user"
                                id="phone_NO"
                                value="">
                        </div>

                        {{-- payment_amount --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>قيمة الدفعة <span style="color:red;">*</span></label>
                            <input
                                type="number"
                                class="form-control form-control-user @error('payment_amount') is-invalid @enderror"
                                id="payment_amount"
                                name="payment_amount"
                                value="{{ old('payment_amount') }}">

                            @error('payment_amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>نوع العملة <span style="color:red;">*</span></label>
                            <select name="currency_type" style="height: 45px;" class="form-control form-control-user @error('currency_type') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="شيكل" {{ old('currency_type') == 'شيكل' ? 'selected' : '' }}>شيكل</option>
                                <option value="دولار" {{ old('currency_type') == 'دولار' ? 'selected' : '' }}>دولار</option>
                                <option value="دينار" {{ old('currency_type') == 'دينار' ? 'selected' : '' }}>دينار</option>
                            </select>

                            @error('currency_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>نوع الدفعة <span style="color:red;">*</span></label>
                            <select name="payment_type" style="height: 45px;" class="form-control form-control-user @error('payment_type') is-invalid @enderror">
                                <option selected disabled value="">اختار...</option>
                                <option value="تحويل" {{ old('payment_type') == 'تحويل' ? 'selected' : '' }}>تحويل</option>
                                <option value="نقد" {{ old('payment_type') == 'نقد' ? 'selected' : '' }}>نقد</option>
                                <option value="شيك" {{ old('payment_type') == 'شيك' ? 'selected' : '' }}>شيك</option>
                            </select>

                            @error('payment_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        {{-- notes --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>الملاحظات </label>
                            <textarea class="form-control form-control-user"
                                      name="notes" rows="3"></textarea>
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $(document).ready(function() {
                $(document).on('change', '#ID_NO', function(e) {
                    let ID_NO = $(this).val();
                    $('#full_name').val('');
                    $('#phone_NO').val('');
                    $.ajax({
                        url: "{{ route('payments.get') }}",
                        method: 'POST',
                        data: {
                            ID_NO: ID_NO,
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                $('#full_name').val(res.customer.full_name);
                                $('#phone_NO').val(res.customer.phone_NO);
                            }
                        },
                    });
                });
            });
        });
    </script>
@endsection

