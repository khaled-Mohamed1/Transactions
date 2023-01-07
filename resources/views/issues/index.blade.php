@extends('layouts.app')

@section('title', 'بيانات القضايات الحالية')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">القضايا الحالية</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('issues.index.all') }}" class="btn btn-sm btn-success">
                        جميع القضايا <i class="fas fa-check"></i>
                    </a>
                </div>
            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">كل القضايا الحالية الفردية</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th width="8%">رقم الاستدلالي</th>
                            <th width="10%">إنشاء بواسطة</th>
                            <th width="5%">رقم الهوية</th>
                            <th width="20%">رقم الجوال</th>
                            <th width="10%">تاريخ الإنشاء</th>
                            <th width="10%">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($customer_issues as $customer_issue)
                            <tr>
                                <td><a href="{{route('customers.show',['customer' => $customer_issue->id])}}">{{ $customer_issue->customer_NO }}</a></td>
                                <td>{{ $customer_issue->UserCustomer->full_name }}</td>
                                <td>{{ $customer_issue->ID_NO }}</td>
                                <td>{{$customer_issue->phone_NO}}</td>
                                <td>{{$customer_issue->created_at}}</td>

                                <td style="display: flex">
                                    <a href="{{route('issues.create.issue.customer',['customer'=>$customer_issue->id])}}"
                                       class="btn btn-primary m-2">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">لا يوجد بيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{ $customer_issues->links() }}
                </div>
            </div>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">كل القضايا الحالية</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th width="8%">رقم الكمبيالة</th>
                            <th width="10%">إنشاء بواسطة</th>
                            <th width="5%">نوع المستند</th>
                            <th width="20%">الأطراف</th>
                            <th width="10%">تاريخ الإنشاء</th>
                            <th width="10%">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($drafts as $draft)
                            <tr>
                                <td><a href="{{route('drafts.show',['draft' => $draft->id])}}">{{ $draft->draft_NO }}</a></td>
                                <td>{{ $draft->UserDraft->full_name }}</td>
                                <td>{{ $draft->document_type }}</td>
                                <td>
                                    @foreach($draft->cusotmerDrafts as $customer)
                                        <a href="{{route('customers.show',['customer' => $customer->customer_id])}}">{{ $customer->DraftCustomer->customer_NO }}</a> -
                                    @endforeach
                                </td>
                                <td>{{$draft->created_at}}</td>

                                <td style="display: flex">
                                    <a href="{{route('issues.create.issue',['draft'=>$draft->id])}}"
                                       class="btn btn-primary m-2">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">لا يوجد بيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{ $drafts->links() }}
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')

@endsection
