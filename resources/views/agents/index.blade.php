@extends('layouts.app')

@section('title', 'بيانات الوكلاء')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">الوكلاء</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('issues.index') }}" class="btn btn-sm btn-info">
                        رجوع للقضايا <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('agents.create') }}" class="btn btn-sm btn-primary">
                        اضافة وكيل <i class="fas fa-plus"></i>
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">كل الوكلاء</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th>#</th>
                            <th width="20%">الإسم</th>
                            <th width="20%">رقم الهوية</th>
                            <th width="20%">العنوان</th>
                            <th width="20%">العنوان</th>
                            <th width="20%">البنوك</th>
                            <th width="20%">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($agents as $key =>$agent)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ $agent->agent_name }}</td>
                                <td>{{ $agent->ID_NO }}</td>
                                <td>{{ $agent->address }}</td>
                                <td>{{ $agent->agent_type }}</td>
                                <td>
                                    @foreach($agent->agentBanks as $key => $bank)
                                         {{++$key}}-  {{ $bank->AgentBank->name }}
                                        <br>
                                    @endforeach
                                </td>
                                <td style="display: flex">
                                    <a href="{{ route('agents.edit', ['agent' => $agent->id]) }}"
                                       class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal{{$agent->id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">لا يوجد بيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{ $agents->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('agents.delete-modal')

@endsection

@section('scripts')

@endsection
