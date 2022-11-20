@extends('layouts.app')

@section('title', 'بيانات الكمبيالات')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">الكمبيالات</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('drafts.create') }}" class="btn btn-sm btn-primary">
                        اضافة جديد <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('drafts.export') }}" class="btn btn-sm btn-success">
                        نصدير اكسل <i class="fas fa-check"></i>
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">كل الكمبيالات</h6>

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
                            <th width="20%">الأطراف</th>
                            <th width="10%">تاريخ الإنشاء</th>
                            <th width="15%">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($drafts as $draft)
                            <tr>
                                <td>{{ $draft->draft_NO }}</td>
                                <td>{{ $draft->UserDraft->full_name }}</td>
                                <td>{{ $draft->document_type }}</td>
                                <td>{{ $draft->customer_qty }}</td>
                                <td>{{ $draft->document_qty }}</td>
                                <td>{{ $draft->document_affiliate }}</td>
                                <td>
                                    @foreach($draft->cusotmerDrafts as $customer)
                                    <a href="{{route('customers.show',['customer' => $customer->customer_id])}}">{{ $customer->DraftCustomer->customer_NO }}</a> -
                                    @endforeach
                                </td>
                                <td>{{$draft->created_at}}</td>
                                <td style="display: flex">
{{--                                    <a href="{{ route('transactions.edit', ['transaction' => $transaction->id]) }}"--}}
{{--                                       class="btn btn-primary m-2">--}}
{{--                                        <i class="fa fa-pen"></i>--}}
{{--                                    </a>--}}
                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$draft->id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a class="btn btn-primary m-2" href="#">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">لا يوجد بيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{ $drafts->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('drafts.delete-modal')

@endsection

@section('scripts')

@endsection
