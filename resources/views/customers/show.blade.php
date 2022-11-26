@extends('layouts.app')

@section('title', 'ملف الشخصي للعميل')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-3 text-gray-800">ملف العميل</h1>
            <form action="{{route('customers.export.WORD')}}" method="POST">
                @csrf
                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                <button class="btn btn-success" type="submit"><i class="las la-print"></i></button>

            </form>
            <div>

                <a href="{{ route('customers.export.customer', ['customer' => $customer->id]) }}" class="btn btn-success m-2">
                    <i class="fas fa-file-csv"></i>
                </a>
                <a href="{{ route('customers.edit', ['customer' => $customer->id]) }}"
                   class="btn btn-primary m-2">
                    <i class="fa fa-pen"></i>
                </a>
{{--                <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$customer->id}}">--}}
{{--                    <i class="fas fa-trash"></i>--}}
{{--                </a>--}}
                @if($customer->status == 'مرفوض')
                @else
                    <a href="{{ route('transactions.create', ['customer' => $customer->id]) }}"
                       class="btn btn-info m-2">
                        <i class="fas fa-plus"></i>
                    </a>
                @endif

            </div>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        {{-- Page Content --}}
        <div class="row">
            <div class="col-md-12 border-right">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">معلومات أساسية</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">العميل</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="15%">رقم الإستدلالي</th>
                                    <th width="15%">الإسم كامل</th>
                                    <th width="10%">رقم الهوية</th>
                                    <th width="10%">رقم الجوال</th>
                                    <th width="5%">المنطقة</th>
                                    <th width="15%">العنوان</th>
                                    <th width="5%">الحالة</th>
                                    <th width="15%">تاريخ إنشاء</th>
                                    <th width="5%">الحساب</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $customer->customer_NO }}</td>
                                        <td>{{ $customer->full_name }}</td>
                                        <td>{{ $customer->ID_NO }}</td>
                                        <td>{{ $customer->phone_NO }}</td>
                                        <td>{{ $customer->region }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>
                                            @if($customer->status == 'مقبول' || $customer->status == 'مكتمل' || $customer->status == 'ملتزم')
                                                <span class="text-success">{{ $customer->status }}</span>
                                            @elseif($customer->status == 'مرفوض' || $customer->status == 'متعسر')
                                                <span class="text-danger">{{ $customer->status }}</span>
                                            @elseif($customer->status == 'قيد التوقيع')
                                                <span class="text-warning">{{ $customer->status }}</span>
                                            @elseif($customer->status == 'قيد العمل')
                                                <span class="text-info">{{ $customer->status }}</span>
                                            @else
                                                {{ $customer->status }}
                                            @endif
                                        </td>
                                        <td>{{ $customer->created_at }}</td>
                                        <td>
                                            @if($customer->account > 0)
                                                <span class="text-danger">{{ $customer->account }}</span>

                                            @elseif($customer->account < 0)
                                                <span class="text-success">{{ $customer->account }}</span>
                                            @else
                                                {{ $customer->account }}
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">ملاحظات</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">العميل</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <h6 class="text-right">{{$customer->notes}}</h6>

                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">معلومات ثانوية</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">العميل</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="10%">رقم جوال البديل</th>
                                    <th width="10%">تاريخ الميلاد</th>
                                    <th width="10%">الحالة الإجتماعية</th>
                                    <th width="10%">الأسرة</th>
                                    <th width="10%">الوظيفة</th>
                                    <th width="10%">الدخل</th>
                                    <th width="10%">اسم البنك</th>
                                    <th width="10%">فرع البنك</th>
                                    <th width="10%">رقم حساب البنك</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $customer->reserve_phone_NO ?? 'لم يدخل'}}</td>
                                    <td>{{ $customer->date_of_birth ?? 'لم يدخل'}}</td>
                                    <td>{{ $customer->marital_status ?? 'لم يدخل'}}</td>
                                    <td>{{ $customer->number_of_children ?? 'لم يدخل'}}</td>
                                    <td>{{ $customer->job ?? 'لم يدخل'}}</td>
                                    <td>{{ $customer->salary ?? 'لم يدخل'}}</td>
                                    <td>{{ $customer->bank_name ?? 'لم يدخل'}}</td>
                                    <td>{{ $customer->bank_branch ?? 'لم يدخل'}}</td>
                                    <td>{{ $customer->bank_account_NO ?? 'لم يدخل'}}</td>
                                </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">المعاملات</h4>
                    <div>
                        @if($customer->updated_by == NULL)
                            <h6 class="text-info text-right">ليس لديه معاملة</h6>
                        @else
                            <h6 class="text-warning text-right">المعاملة لم تنجز</h6>
                        @endif
                        <form action="" method="POST" class="test">
                            <input type="hidden" name="customer_id" id="customer_id{{$customer->id}}" value="{{$customer->id}}">
                            <select name="user_id" id="select{{$customer->id}}"  class="form-control form-control-user @error('user_id') is-invalid @enderror">
                                <option  value="false">إلغاء</option>
                                @foreach($users as $user)
                                    <option id="option{{$customer->id}}" value="{{$user->id}}" {{old('user_id') ? ((old('user_id') == $user->id) ? 'selected' : '')
                                                : (($user->id == $customer->updated_by) ? 'selected' : '')}}>{{$user->full_name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </form>
                    </div>

                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">العميل</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="5%">رقم المعاملة</th>
                                    <th width="5%">نوع المعاملة</th>
                                    <th width="5%">قيمة المعاملة</th>
                                    <th width="5%">الدفعة الأولى</th>
                                    <th width="5%">باقي قيمة المعاملة</th>
                                    <th width="5%">دفعة الشهرية</th>
                                    <th width="10%">تاريخ أول دفعة</th>
                                    <th width="5%">عدد الكمبيالات</th>
                                    <th width="5%">عدد الوكالات</th>
                                    <th width="5%">عدد الإستقراء</th>
                                    <th width="5%">عدد الوصل</th>
                                    <th width="5%">تاريخ الإنشاء</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($customer->transactions as $transaction)

                                    <tr>
                                        <td>{{ $transaction->transaction_NO }}</td>
                                        <td>{{ $transaction->transactions_type }}</td>
                                        <td>{{ $transaction->transaction_amount }}</td>
                                        <td>{{ $transaction->first_payment }}</td>
                                        <td>{{ $transaction->transaction_rest }}</td>
                                        <td>{{ $transaction->monthly_payment }}</td>
                                        <td>{{ $transaction->date_of_first_payment }}</td>
                                        <td>{{ $transaction->draft_NO }}</td>
                                        <td>{{ $transaction->agency_NO }}</td>
                                        <td>{{ $transaction->endorsement_NO }}</td>
                                        <td>{{ $transaction->receipt_NO }}</td>
                                        <td>{{ $transaction->created_at }}</td>

                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="13">لا يوجد بيانات</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                {{-- Drafts --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">الكمبيالات</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">العميل</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="10%">رقم الكمبيالة</th>
                                    <th width="15%">إنشاء بواسطة</th>
                                    <th width="10%">نوع المستند</th>
                                    <th width="10%">عدد الأفراد</th>
                                    <th width="10%">عدد المستند</th>
                                    <th width="10%">مستند تابع</th>
                                    <th width="10%">تاريخ الإنشاء</th>
{{--                                    <th width="15%">العمليات</th>--}}
                                </tr>
                                </thead>
                                <tbody>

                                @forelse ($drafts as $draft)
                                    <tr>
                                        <td>{{ $draft->DraftCustomerDraft->draft_NO }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->UserDraft->full_name }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->document_type }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->customer_qty }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->document_qty }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->document_affiliate }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->created_at }}</td>
{{--                                        <td style="display: flex">--}}
                                            {{--                                    <a href="{{ route('transactions.edit', ['transaction' => $transaction->id]) }}"--}}
                                            {{--                                       class="btn btn-primary m-2">--}}
                                            {{--                                        <i class="fa fa-pen"></i>--}}
                                            {{--                                    </a>--}}
{{--                                            <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{ $draft->DraftCustomerDraft->id }}">--}}
{{--                                                <i class="fas fa-trash"></i>--}}
{{--                                            </a>--}}
                                            {{--                                                <a class="btn btn-primary m-2" href="#">--}}
                                            {{--                                                    <i class="fas fa-plus"></i>--}}
                                            {{--                                                </a>--}}
{{--                                        </td>--}}
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="9">لا يوجد بيانات</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                {{-- Issue --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">القضايا</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">العميل</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="10%">رقم</th>
                                    <th width="10%">إنشاء بواسطة</th>
                                    <th width="10%">اسم المحكمة</th>
                                    <th width="10%">رقم القضية</th>
                                    <th width="10%">مبلغ القضية</th>
                                    <th width="10%">طالب التنفيذ</th>
                                    <th width="10%">وكيل طالب التنفيذ</th>
                                    <th width="10%">وكيل المنفذ ضده</th>
                                    <th width="10%">الحاله</th>
                                    <th width="10%">ملاحظات</th>
                                    <th width="10%">تاريخ الإنشاء</th>
{{--                                    <th width="10%">العمليات</th>--}}
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($issues as $issue)
                                    <tr>
                                        <td>{{ $issue->IssueCustomerIssue->issue_NO }}</td>
                                        <td>{{ $issue->IssueCustomerIssue->UserIssue->full_name }}</td>
                                        <td>{{ $issue->IssueCustomerIssue->court_name }}</td>
                                        <td>{{ $issue->IssueCustomerIssue->case_number }}</td>
                                        <td>{{ $issue->IssueCustomerIssue->case_amount }}</td>
                                        <td>{{ $issue->IssueCustomerIssue->execution_request_idIssue->agent_name ?? null }}</td>
                                        <td>{{ $issue->IssueCustomerIssue->execution_agent_name_idIssue->agent_name ?? null }}</td>
                                        <td>{{ $issue->IssueCustomerIssue->execution_agent_against_it_idIssue->agent_name ?? null }}</td>
                                        <td>{{ $issue->IssueCustomerIssue->issue_status }}</td>
                                        <td>{{ $issue->IssueCustomerIssue->notes }}</td>
                                        <td>{{ $issue->IssueCustomerIssue->created_at }}</td>
{{--                                        <td style="display: flex">--}}
                                            {{--                                        <a href="{{ route('transactions.edit', ['transaction' => $transaction->id]) }}"--}}
                                            {{--                                           class="btn btn-primary m-2">--}}
                                            {{--                                            <i class="fa fa-pen"></i>--}}
                                            {{--                                        </a>--}}
{{--                                            <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$issue->id}}">--}}
{{--                                                <i class="fas fa-trash"></i>--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11">لا يوجد بيانات</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                {{-- payments --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">الدفعات</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">العميل</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="10%">رقم الدفعة</th>
                                    <th width="10%">إنشاء بواسطة</th>
                                    <th width="10%">قيمة الدفعة</th>
                                    <th width="15%">تاريخ الدفع</th>
                                    <th width="15%">نوعة الدفعة</th>
                                    <th width="15%">عن طريق</th>
                                    <th width="20%">ملاحظات</th>
                                    <th width="10%">العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($customer->payments as $payment)
                                    <tr>
                                        <td>{{ $payment->payment_NO }}</td>
                                        <td>{{ $payment->UserPayment->full_name }}</td>
                                        <td>{{ $payment->payment_amount }}</td>
                                        <td>{{ $payment->created_at }}</td>
                                        <td>{{ $payment->payment_type }}</td>
                                        <td>{{ $payment->payment_via }}</td>
                                        <td>{{ $payment->notes }}</td>
                                        <td style="display: flex">
                                            <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$payment->id}}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">لا يوجد بيانات</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                {{-- purchases --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">المشتريات</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">العميل</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-info">
                                    <th width="10%">رقم</th>
                                    <th width="10%">إنشاء بواسطة</th>
                                    <th width="10%">رقم المعاملة</th>
                                    <th width="15%">اسم المنتج</th>
                                    <th width="15%">الكمية</th>
                                    @hasrole('المدير العام')
                                    <th width="15%">نسبة %</th>
                                    <th width="20%">الربح</th>
                                    @endhasrole
                                    @hasrole('Admin')
                                    <th width="15%">نسبة %</th>
                                    <th width="20%">الربح</th>
                                    @endhasrole
                                    {{--                                    <th width="10%">العمليات</th>--}}

                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($customer->purchases as $key => $purchase)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $purchase->UserPurchase->full_name }}</td>
                                        <td>{{ $purchase->TransactionPurchase->transaction_NO ?? null}}</td>
                                        <td>{{ $purchase->StorePurchase->product_name }}</td>
                                        <td>{{ $purchase->product_qty }}</td>
                                        @hasrole('المدير العام')
                                        <td>{{ $purchase->profit_ratio }}</td>
                                        <td class="text-success">{{ $purchase->profit }}</td>
                                        @endhasrole
                                        @hasrole('Admin')
                                        <td>{{ $purchase->profit_ratio }}</td>
                                        <td class="text-success">{{ $purchase->profit }}</td>
                                        @endhasrole

                                        {{--                                        <td style="display: flex">--}}
{{--                                            <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$payment->id}}">--}}
{{--                                                <i class="fas fa-trash"></i>--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
                                    </tr>
                                @empty
                                    @hasrole('المدير العام')
                                    <tr>
                                        <td colspan="7">لا يوجد بيانات</td>
                                    </tr>
                                    @endhasrole

                                    @hasrole('Admin')
                                    <tr>
                                        <td colspan="7">لا يوجد بيانات</td>
                                    </tr>
                                    @endhasrole

                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                {{-- Attachments --}}
                <div class="p-3 py-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">المرفقات</h4>
                        <a href="{{ route('customers.attachment.create', ['customer' => $customer->id]) }}"
                           class="btn btn-success m-2">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="row mt-2">
                        @forelse($customer->attachments as $attachment)
                            <div class="col-4 mb-4 text-right">
                                <div class="card" style="width: 20rem;">
                                    <a href="{{route('customers.attachment.show',['attachment'=>$attachment->id])}}"><img height="250px" src="{{asset($attachment->attachment)}}" class="card-img-top" alt="..."></a>
                                    <div class="card-body bg-gray-100" style="width: 100%">
                                        <p class="card-text">{{$attachment->title}}</p>
                                        <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$attachment->id}}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            لا يوجد مرفقات
                        @endforelse

                    </div>
                </div>

            </div>



        </div>



    </div>
    @include('customers.attachment-delete')
    @include('payments.delete-modal')


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

            let customer = {!! $customer->toJson() !!};

            $(".test").each(function(index) {
                $(document).on('change', '#select'+customer.id, function(e) {
                    let user_id = $(this).val();
                    let customer_id = customer.id;
                    if (confirm('هل تريد اضافة المهمة للموظف؟')){
                        $.ajax({
                            url: "{{ route('customers.add.task') }}",
                            method: 'POST',
                            data: {
                                user_id: user_id,
                                customer_id: customer_id,
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    location.reload();
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>

@endsection

