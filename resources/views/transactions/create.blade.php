@extends('layouts.app')

@section('title', 'اضافة معاملة')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">اضافة معاملة</h1>
            <a href="{{route('transactions.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">اضافة معاملة جديد</h6>
            </div>
            <form method="POST" action="{{route('transactions.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">

                        {{-- customer_id --}}

                        <input
                            type="hidden"
                            class="form-control form-control-user"
                            id="customer_id"
                            name="customer_id"
                            value="{{$customer->id}}">

                        {{-- full_name --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الأسم كامل <span style="color:red;">*</span></label>
                            <input
                                disabled
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user @error('full_name') is-invalid @enderror"
                                id="full_name"
                                name="full_name"
                                value="{{$customer->full_name}}">
                            @error('full_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- customer_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الإستدلالي <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"
                                disabled
                                type="text"
                                class="form-control form-control-user @error('customer_NO') is-invalid @enderror"
                                id="customer_NO"
                                name="customer_NO"
                                value="{{$customer->customer_NO}}">
                            @error('customer_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- ID_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم الهوية <span style="color:red;">*</span></label>
                            <input
                                disabled
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user @error('ID_NO') is-invalid @enderror"
                                id="ID_NO"
                                name="ID_NO"
                                value="{{$customer->ID_NO}}">
                            @error('ID_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        {{-- phone_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>رقم الجوال <span style="color:red;">*</span></label>
                            <input
                                disabled
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user @error('phone_NO') is-invalid @enderror"
                                id="phone_NO"
                                name="phone_NO"
                                value="{{$customer->phone_NO}}">
                            @error('phone_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- region --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>المنطقة <span style="color:red;">*</span></label>
                            <input
                                disabled
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user @error('region') is-invalid @enderror"
                                id="region"
                                name="region"
                                value="{{$customer->region}}">
                            @error('region')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- address --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>العنوان <span style="color:red;">*</span></label>
                            <input
                                disabled
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user @error('address') is-invalid @enderror"
                                id="address"
                                name="address"
                                value="{{$customer->address}}">
                            @error('address')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- account --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>الحساب <span style="color:red;">*</span></label>
                            <input
                                disabled
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user @error('account') is-invalid @enderror"
                                id="account"
                                name="account"
                                value="{{$customer->account}}">
                            @error('account')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transactions_type --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>نوع المعاملة <span style="color:red;">*</span></label>
                            <select name="transactions_type" class="form-control form-control-user @error('transactions_type') is-invalid @enderror"
                                    style="height: 45px">
                                <option  disabled selected>اختر...</option>
                                <option value="ودي" {{ old('transactions_type') == 'ودي' ? 'selected' : '' }}>ودي</option>
                                <option value="استقطاع" {{ old('transactions_type') == 'استقطاع' ? 'selected' : '' }}>استقطاع</option>
                                <option value="شيكات" {{ old('transactions_type') == 'شيكات' ? 'selected' : '' }}>شيكات</option>
                                <option value="قروض" {{ old('transactions_type') == 'قروض' ? 'selected' : '' }}>قروض</option>
                            </select>
                            @error('transactions_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- reserve_phone_NO --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>رقم البديل </label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user"
                                id="examplereserve_phone_NO"
                                name="reserve_phone_NO"
                                value="{{ $customer->reserve_phone_NO }}">

                        </div>

                        {{-- date_of_birth --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>تاريخ الميلاد <span style="color:red;">*</span></label>
                            <input
                                disabled
                                style="height: 45px"
                                type="date"
                                class="form-control form-control-user @error('date_of_birth') is-invalid @enderror"
                                id="exampledate_of_birth"
                                name="date_of_birth"
                                value="{{ $customer->date_of_birth }}">

                            @error('date_of_birth')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- marital_status --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الحالة الإجتماعية <span style="color:red;">*</span></label>
                            <select name="marital_status" disabled style="height: 45px" class="form-control form-control-user @error('marital_status') is-invalid @enderror">
                                <option disabled {{ $customer->marital_status == null ? 'selected' : '' }}>اختر...</option>
                                <option value="اعزب" {{ $customer->marital_status == 'اعزب' ? 'selected' : '' }}>اعزب</option>
                                <option value="متزوج" {{ $customer->marital_status == 'متزوج' ? 'selected' : '' }}>متزوج</option>
                                <option value="مطلق" {{ $customer->marital_status == 'مطلق' ? 'selected' : '' }}>مطلق</option>
                            </select>

                            @error('marital_status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- number_of_children --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>أفراد العائلة <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"
                                disabled
                                type="number"
                                class="form-control form-control-user @error('number_of_children') is-invalid @enderror"
                                id="examplenumber_of_children"
                                name="number_of_children"
                                min="0"
                                value="{{ $customer->number_of_children }}">

                            @error('number_of_children')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- job --}}
                        <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                            <label>الوظيفة <span style="color:red;">*</span></label>
                            <select name="job" style="height: 45px"
                                    class="form-control form-control-user @error('job') is-invalid @enderror" disabled>
                                <option disabled selected>اختر...</option>
                                @foreach($jobs as $job)
                                    <option value="{{$job->id}}" {{ $customer->CustomerJob->name == $job->name ? 'selected' : '' }}>{{$job->name}}</option>
                                @endforeach
                            </select>

                            @error('job')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- salary --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>الدخل <span style="color:red;">*</span></label>
                            <input
                                disabled
                                style="height: 45px"
                                type="number"
                                class="form-control form-control-user @error('salary') is-invalid @enderror"
                                id="salary"
                                name="salary"
                                min="0"
                                value="{{ $customer->salary  }}">

                            @error('salary')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_name --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>اسم البنك</label>
                            <select name="bank_name" style="height: 45px" class="form-control form-control-user @error('bank_name') is-invalid @enderror">
                                <option disabled {{ $customer->CustomerBank->name == null ? 'selected' : '' }}>اختر...</option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}" {{ $customer->CustomerBank->name == $bank->name ? 'selected' : '' }}>{{$bank->name}}</option>
                                @endforeach
                            </select>

                            @error('bank_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_branch --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>فرع البنك</label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user @error('bank_branch') is-invalid @enderror"
                                id="bank_branch"
                                name="bank_branch"
                                value="{{ $customer->bank_branch }}">

                            @error('bank_branch')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- bank_account_NO --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>رقم حساب البنك</label>
                            <input
                                style="height: 45px"
                                type="text"
                                class="form-control form-control-user @error('bank_account_NO') is-invalid @enderror"
                                id="bank_account_NO"
                                name="bank_account_NO"
                                value="{{ $customer->bank_branch }}">

                            @error('bank_account_NO')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transaction_amount --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>قيمة المعاملة <span style="color:red;">*</span></label>
                            <input
                                disabled
                                style="height: 45px"
                                min="1"
                                type="number"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="transaction_amount_Disable"
                                name="transaction_amount_Disable">

                            @error('transaction_amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <input
                            type="hidden"
                            class="form-control form-control-user"
                            id="transaction_amount"
                            name="transaction_amount">

                        {{-- first_payment --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>أول دفعة <span style="color:red;">*</span></label>
                            <input

                                style="height: 45px"
                                min="1"
                                type="number"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="first_payment"
                                name="first_payment">
                            @error('first_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- transaction_rest --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>باقي قيمة المعاملة <span style="color:red;">*</span></label>
                            <input
                                disabled
                                style="height: 45px"
                                min="1"
                                type="number"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="transaction_rest_Disable"
                                name="transaction_rest_Disable">
                            @error('transaction_rest')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <input
                            type="hidden"
                            class="form-control form-control-user"
                            id="transaction_rest"
                            name="transaction_rest">

                        {{-- monthly_payment --}}
                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                            <label>قيمة الدفعة الشهرية <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"
                                min="1"
                                type="number"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="monthly_payment"
                                name="monthly_payment">
                            @error('monthly_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- date_of_first_payment --}}
                        <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                            <label>تاريخ أول دفعة <span style="color:red;">*</span></label>
                            <input
                                style="height: 45px"
                                type="date"
                                class="form-control form-control-user @error('transaction_amount') is-invalid @enderror"
                                id="date_of_first_payment"
                                name="date_of_first_payment">
                            @error('date_of_first_payment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- stores--}}
                        <div class="col-sm-12 mb-3 mt-5 mb-sm-0">
                            <h5>المنتجات</h5>
                            <div class="p-3">
                                <table class="table text-center table-bordered" id="tablePest">
                                    <thead class="text-info">
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المنتج</th>
                                        <th>الكمية</th>
                                        <th>سعر المنتج بالجملة</th>
                                        @hasrole('المدير العام')
                                        <th>الربح الصافي</th>
                                        @endhasrole
                                        @hasrole('Admin')
                                        <th>الربح الصافي</th>
                                        @endhasrole

                                        <th><button type="button" name="add"
                                                    class="btn btn-success btn-xs add"><i
                                                    class="las la-plus"></i></button></th>
                                    </tr>
                                    </thead>
                                    <tbody class="product_body">
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        {{-- notes --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            <label>الملاحظات </label>
                            <textarea class="form-control form-control-user" disabled
                                      name="notes"  rows="3">{{ $customer->notes  }}</textarea>
                        </div>



                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">اضافة</button>
                    <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('transactions.index') }}">إلغاء</a>
                </div>
            </form>
        </div>

    </div>

@endsection


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('contextmenu', function(event) {
                // Prevent the default context menu from appearing
                event.preventDefault();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let stores = {!! $stores->toJson() !!};
            var count = 0;
            var rowIdx = 0;

            $(document).on('click', '.add', function() {
                count++;
                var html = '';
                html += `<tr id="R${++rowIdx}">`;
                html += `<td class="row-index text-center" ><p>${rowIdx}</p></td>`;
                html +=
                    `<td><select name="product_name[]" style="height: 45px" id="product_name${count}" class="form-control form-control-user product_name" data-sub_product_id="${count}" ><option value="">اختر...</option>@foreach ($stores as $store) <option value="{{ $store->id }}"> {{ $store->product_name }} @endforeach</select></td>`;
                html +=
                    `<td><input name="product_qty[]" style="height: 45px" id="product_qty${count}" type="number" min="1" class="form-control form-control-user product_qty${count}"></td>`;
                html += `<td class="product_price${count} test2"></td>`;
                html += `<input type="hidden" name="profit_ratio[]" class="profit_ratio${count} test3"/>`;
                html += `<input type="hidden" name="total[]" class="total${count} test"/>`;
                html += `<td class="profit${count}"></td>`;
                html += `<input type="hidden" name="hiddenProfit[]" class="hiddenProfit${count}"/>`;
                html +=
                    `<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><i class="las la-trash-alt"></i></button></td>`;
                $('.product_body').append(html);
            });


            $(document).on('click', '.remove', function() {
                --count;
                $(this).closest('tr').remove();

            });

            $(document).on('change', '.product_name', function() {
                var product_id = $(this).val();
                var sub_product_id = $(this).data('sub_product_id');

                $.ajax({
                    url: "{{ route('transactions.get.product') }}",
                    method: "POST",
                    data: {
                        product_id: product_id
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            console.log(res)
                            $('.product_price'+sub_product_id).html(res.getProduct[0].product_price);
                            $('.profit_ratio'+sub_product_id).val(res.getProduct[0].profit_ratio);
                        }
                    },
                })

                $(document).on('change', '.product_qty'+sub_product_id, function() {
                    let product_qty = $(this).val();
                    let profit_ratio = $('.profit_ratio'+sub_product_id).val();
                    let product_price = $('.product_price'+sub_product_id).html();
                    let product_value = product_price * product_qty - ((product_price * product_qty) - ((product_price * product_qty) * profit_ratio) / 100)
                    $('.total'+sub_product_id).val(product_price * product_qty);
                    $('.hiddenProfit'+sub_product_id).val(parseFloat(product_value).toFixed(2));
                    $('.profit'+sub_product_id).html(parseFloat(product_value).toFixed(2));
                    let product_sum = 0;
                    $('.test').each(function() {
                        var get_value = $(this).val();
                        if ($.isNumeric(get_value)) {
                            product_sum += parseFloat(get_value);
                        }
                    });

                    $('#transaction_amount_Disable').val(product_sum.toFixed(2));
                    $('#transaction_amount').val(product_sum.toFixed(2));
                    $('#first_payment').val('');
                    $('#transaction_rest_Disable').val('');
                    $('#transaction_rest').val('');

                });

                $(document).on('change', '#first_payment', function() {
                    let first_payment = $(this).val();
                    let transaction_amount = $('#transaction_amount_Disable').val();
                    $('#transaction_rest_Disable').val(transaction_amount - first_payment);
                    $('#transaction_rest').val(transaction_amount - first_payment);

                });

            });


        });
    </script>

@endsection

