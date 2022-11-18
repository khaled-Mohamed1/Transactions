@extends('layouts.app')

@section('title', 'المرفق')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">المرفق</h1>
            <a href="{{route('customers.show',['customer' => $attachment->CustomerAttachment->id])}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">رجوع <i
                    class="fas fa-arrow-left fa-sm text-white-50"></i></a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4 text-right">

                <div class="card-body">
                    <img src="{{asset($attachment->attachment)}}" class="card-img-top" alt="...">
                </div>
        </div>

    </div>

@endsection
