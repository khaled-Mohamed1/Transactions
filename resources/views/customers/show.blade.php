@extends('layouts.app')

@section('title', 'CustomerProfile')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        {{-- Page Content --}}
        <div class="row">
            <div class="col-md-12 border-right">
                {{-- Profile --}}
                <div class="p-3 py-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile</h4>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3" style="border-right: 2px solid #d7d7d7" >
                            <h5 class=" text-gray-900">Full Name: <span class="h6 text-gray-800">{{$customer->full_name}}</span></h5>
                            <h5 class=" text-gray-900">Customer_NO: <span class="h6 text-gray-800">{{$customer->customer_NO}}</span></h5>
                        </div>
                        <div class="col-md-3" style="border-right: 2px solid #d7d7d7">
                            <h5 class=" text-gray-900">ID_NO: <span class="h6 text-gray-800">{{$customer->ID_NO}}</span></h5>
                            <h5 class=" text-gray-900">Phone_NO: <span class="h6 text-gray-800">{{$customer->phone_NO}}</span></h5>
                        </div>
                        <div class="col-md-3" style="border-right: 2px solid #d7d7d7">
                            <h5 class=" text-gray-900">Region: <span class="h6 text-gray-800">{{$customer->region}}</span></h5>
                            <h5 class=" text-gray-900">Address: <span class="h6 text-gray-800">{{$customer->address}}</span></h5>
                        </div>
                        <div class="col-md-3">
                            <h5 class=" text-gray-900">Status: <span class="h6 text-gray-800">{{$customer->status}}</span></h5>
                            <h5 class=" text-gray-900">Account: <span class="h6 text-gray-800">{{$customer->account}}</span></h5>
                        </div>
                    </div>
                </div>


                <hr>

                {{-- Bills --}}
                <div class="p-3 py-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Bills</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="30%">Product_Name</th>
                                    <th width="20%">Product_Quantity</th>
                                    <th width="20%">Price</th>
                                    <th width="20%">Profit</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6">No record</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <hr>

                {{-- Bills --}}
                <div class="p-3 py-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Attachments</h4>
                    </div>
                    <div class="row mt-2">
                        No Attachments
                    </div>
                </div>

            </div>



        </div>



    </div>
@endsection
