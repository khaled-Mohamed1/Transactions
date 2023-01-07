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
                            <th width="10%">نوع المستند</th>
                            <th width="10%">عدد المستند</th>
                            <th width="10%">مستند تابع</th>
                            <th width="25%">الأطراف</th>
                            <th width="10%">عدد القضايا</th>
                            <th width="10%">العمليات</th>
                            @hasrole('Admin')
                            <th width="10%">إضافة إلى</th>
                            @endhasrole

                            @hasrole('المدير العام')
                            <th width="10%">إضافة إلى</th>
                            @endhasrole
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
                                <td style="display: flex">
                                    <a href="{{ route('drafts.edit', ['draft' => $draft->id]) }}"
                                       class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$draft->id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                @hasrole('Admin')
                                <td>
                                @if($draft->document_qty <= 0 || $draft->document_affiliate <= 0 )
                                        <span class="text-danger">لا يمكن اجراء قضية</span>

                                    @else
                                    {{$draft->updated_by != NULL ? 'تم اعطاء' : ''}}
                                        <a class="btn btn-info m-2" href="#" data-toggle="modal" data-target="#addModal{{$draft->id}}">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    @endif

                                    </td>
                                @endhasrole
                                @hasrole('المدير العام')
                                <td>
                                    @if($draft->customer_qty <= 0 || $draft->document_affiliate <= 0 )
                                        <span class="text-danger">لا يمكن اجراء قضية</span>

                                    @else
                                        {{$draft->updated_by != NULL ? 'تم اعطاء' : ''}}
                                    <a class="btn btn-info m-2" href="#" data-toggle="modal" data-target="#addModal{{$draft->id}}">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    @endif

                                </td>
                                @endhasrole

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
    @include('drafts.add-modal')

@endsection

