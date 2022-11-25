@extends('layouts.app')

@section('title', 'بيانات المخزن')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">المخازن</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('stores.create') }}" class="btn btn-sm btn-primary">
                        اضافة منتج <i class="fas fa-plus"></i>
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">محتوايات المخزن</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th>#</th>
                            <th width="25%">اسم المنتج</th>
                            <th width="25%">انشاء بواسطة</th>
                            <th width="25%">الكمية المتبقية</th>
                            <th width="25%">السعر بالجملة</th>
                            <th width="25%">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($stores as $key => $store)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ $store->product_name }}</td>
                                <td>{{ $store->UserStore->full_name }}</td>
                                <td>
                                    @if($store->product_qty < 15)
                                        <span class="text-danger">{{ $store->product_qty }} الكمية على وشك النفاذ</span>
                                    @else
                                        {{ $store->product_qty }}
                                    @endif
                                </td>
                                <td>{{ $store->product_price }}</td>
                                <td style="display: flex">
                                    <a href="{{ route('stores.edit', ['store' => $store->id]) }}"
                                       class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$store->id}}">
                                        <i class="fas fa-trash"></i>
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

                    {{ $stores->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('stores.delete-modal')

@endsection

@section('scripts')

@endsection
