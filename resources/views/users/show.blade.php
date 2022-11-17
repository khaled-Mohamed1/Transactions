@extends('layouts.app')

@section('title', 'ملف الشخصي للموظف')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-3 text-gray-800">ملف الموظف</h1>
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
                        <h6 class="m-0 font-weight-bold text-primary text-right">الموظف</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="20%">اسم</th>
                                    <th width="25%">البريد الإلكتروني</th>
                                    <th width="15%">رقم الجوال</th>
                                    <th width="15%">الوظيفة</th>
                                    <th width="15%">حالة النشاط</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile_number }}</td>
                                    <td>{{ $user->roles ? $user->roles->pluck('name')->first() : 'N/A' }}</td>
                                    <td>
                                        @if ($user->status == 0)
                                            <span class="badge badge-danger">غير نشط</span>
                                        @elseif ($user->status == 1)
                                            <span class="badge badge-success">نشط</span>
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
                                <tr>
                                    <th width="15%">رقم الإستدلالي</th>
                                    <th width="15%">الإسم كامل</th>
                                    <th width="10%">رقم الهوية</th>
                                    <th width="10%">رقم الجوال</th>
                                    <th width="5%">المنطقة</th>
                                    <th width="15%">العنوان</th>
                                    <th width="5%">الحالة</th>
                                    <th width="5%">الحساب</th>
                                    <th width="15%">تاريخ إنشاء</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($user->customers->take(99) as $customer)
                                <tr>
                                    <td>{{ $customer->customer_NO }}</td>
                                    <td>{{ $customer->full_name }}</td>
                                    <td>{{ $customer->ID_NO }}</td>
                                    <td>{{ $customer->phone_NO }}</td>
                                    <td>{{ $customer->region }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>
                                        @if($customer->status == 'مقبول' || $customer->status == 'مكتمل')
                                            <span class="text-success">{{ $customer->status }}</span>
                                        @elseif($customer->status == 'مرفوض' || $customer->status == 'متعسر')
                                            <span class="text-danger">{{ $customer->status }}</span>
                                        @else
                                            {{ $customer->status }}
                                        @endif
                                    </td>
                                    <td>{{ $customer->account }}</td>
                                    <td>{{ $customer->created_at }}</td>

                                </tr>
                                @empty
                                    <td colspan="9">لا يوجد بيانات</td>

                                @endforelse

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">المعاملات</h4>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-right">العميل</h6>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
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
                                @forelse($user->transactions->take(100) as $transaction)

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
                                    <td colspan="13">لا يوجد بيانات</td>
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
                                <tr>
                                    <th width="10%">رقم الكمبيالة</th>
                                    <th width="15%">إنشاء بواسطة</th>
                                    <th width="10%">نوع المستند</th>
                                    <th width="10%">عدد الأفراد</th>
                                    <th width="10%">عدد المستند</th>
                                    <th width="10%">مستند تابع</th>
                                    <th width="10%">تاريخ الإنشاء</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @forelse ($user->drafts->take(100) as $draft)
                                    <tr>
                                        <td>{{ $draft->DraftCustomerDraft->draft_NO }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->UserDraft->full_name }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->document_type }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->customer_qty }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->document_qty }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->document_affiliate }}</td>
                                        <td>{{ $draft->DraftCustomerDraft->created_at }}</td>
                                    </tr>
                                @empty
                                    <td colspan="9">لا يوجد بيانات</td>
                                    @endforelse
                                    </tr>
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
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">رقم القضية</th>
                                    <th width="20%">رقم القضية</th>
                                    <th width="20%">رقم القضية</th>
                                    <th width="20%">رقم القضية</th>
                                    <th width="15%">العمليات</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td colspan="6">لا يوجد بيانات</td>
                                </tr>
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
                    </div>
                    <div class="row mt-2">
                        لا يوجد مرفقات
                    </div>
                </div>

            </div>



        </div>



    </div>


@endsection

