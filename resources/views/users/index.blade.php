@extends('layouts.app')

@section('title', 'Users List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">الموظفين</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                         اضافة جديد <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('users.export') }}" class="btn btn-sm btn-success" >
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
                <h6 class="m-0 font-weight-bold text-primary text-right">كل الموظفين</h6>

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
{{--                                <th width="15%">حالة النشاط</th>--}}
                                <th width="10%">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><a href="{{route('users.show',['user' => $user->id])}}">{{ $user->full_name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile_number }}</td>
                                    <td>{{ $user->roles ? $user->roles->pluck('name')->first() : 'N/A' }}</td>
{{--                                    <td>--}}
{{--                                        @if ($user->status == 0)--}}
{{--                                            <span class="badge badge-danger">غير نشط</span>--}}
{{--                                        @elseif ($user->status == 1)--}}
{{--                                            <span class="badge badge-success">نشط</span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                    <td style="display: flex">
{{--                                        @if ($user->status == 0)--}}
{{--                                            <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 1]) }}"--}}
{{--                                                class="btn btn-success m-2">--}}
{{--                                                <i class="fa fa-check"></i>--}}
{{--                                            </a>--}}
{{--                                        @elseif ($user->status == 1)--}}
{{--                                            <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 0]) }}"--}}
{{--                                                class="btn btn-danger m-2">--}}
{{--                                                <i class="fa fa-ban"></i>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                            class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('users.delete-modal')

@endsection

@section('scripts')

@endsection
