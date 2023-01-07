@extends('layouts.app')

@section('title', 'بيانات وظائف العملاء')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">وظائف العملاء</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('jobs.create') }}" class="btn btn-sm btn-primary">
                        اضافة وظيفة <i class="fas fa-plus"></i>
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">كل الوظائف</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th width="5%">#</th>
                            <th width="20%">الإسم</th>
                            <th width="20%">تاريخ الإنشاء</th>
                            <th width="20%">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($jobs as $key => $job)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ $job->name }}</td>
                                <td>{{ $job->created_at }}</td>
                                <td style="display: flex">
                                    <a href="{{ route('jobs.edit', ['CustomerJob' => $job->id]) }}"
                                       class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$job->id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">لا يوجد بيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{ $jobs->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('jobs.delete-modal')

@endsection

@section('scripts')

@endsection
