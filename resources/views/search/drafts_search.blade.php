@extends('layouts.app')

@section('title', 'بيانات الكمبيالات')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">الكمبيالات</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">نتائج البحث عن الكمبيالات</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th width="10%">رقم الكمبيالة</th>
                            <th width="10%">نوع المستند</th>
                            <th width="10%">عدد المستند</th>
                            <th width="10%">مستند تابع</th>
                            <th width="25%">الأطراف</th>
                            <th width="10%">عدد القضايا</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($drafts as $draft)
                            <tr>
                                <td><a href="{{route('drafts.show',['draft' => $draft->id])}}">{{ $draft->draft_NO }}</a></td>
                                <td>{{ $draft->document_type }}</td>
                                <td>{{ $draft->document_qty }}</td>
                                <td>{{ $draft->document_affiliate }}</td>
                                <td>
                                    @foreach($draft->cusotmerDrafts as $customer)
                                        <a href="{{route('customers.show',['customer' => $customer->customer_id])}}">{{ $customer->DraftCustomer->customer_NO }}</a> -
                                    @endforeach
                                </td>
                                <td>{{$draft->issues->count()}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">لا يوجد بيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection

