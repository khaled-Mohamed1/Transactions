@extends('layouts.app')

@section('title', 'المتابعة')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">المتابعة</h1>
            <div class="row">
                {{--                <div class="col-md-6">--}}
                {{--                    <a href="{{ route('customers.create') }}" class="btn btn-sm btn-primary">--}}
                {{--                        <i class="fas fa-plus"></i> Add New--}}
                {{--                    </a>--}}
                {{--                </div>--}}
                {{--                <div class="col-md-12">--}}
                {{--                    <a href="{{ route('customers.export.adverser') }}" class="btn btn-sm btn-success">--}}
                {{--                        <i class="fas fa-check"></i> Export To Excel--}}
                {{--                    </a>--}}
                {{--                </div>--}}
            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-right">المتابعة</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-right" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-info">
                            <th width="15%">رقم الإستدلالي</th>
                            <th width="15%">الإسم كامل</th>
                            <th width="10%">رقم الهوية</th>
                            <th width="10%">رقم الجوال</th>
                            <th width="5%">المنطقة</th>
                            <th width="15%">العنوان</th>
                            <th width="5%">الحالة</th>
                            <th width="5%">الحساب</th>
                            <th width="10%">المتابعة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td><a href="{{route('customers.show',['customer' => $customer->id])}}">{{ $customer->customer_NO }}</a></td>
                                <td>{{ $customer->full_name }}</td>
                                <td>{{ $customer->ID_NO }}</td>
                                <td>{{ $customer->phone_NO }}</td>
                                <td>{{ $customer->region }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    @if($customer->status == 'مقبول' || $customer->status == 'مكتمل' || $customer->status == 'ملتزم')
                                        <span class="text-success">{{ $customer->status }}</span>
                                    @elseif($customer->status == 'مرفوض' || $customer->status == 'متعسر')
                                        <span class="text-danger">{{ $customer->status }}</span>
                                    @elseif($customer->status == 'قيد التوقيع')
                                        <span class="text-warning">{{ $customer->status }}</span>
                                    @elseif($customer->status == 'قيد العمل')
                                        <span class="text-info">{{ $customer->status }}</span>
                                    @else
                                        {{ $customer->status }}
                                    @endif
                                </td>
                                <td>{{ $customer->account }}</td>
                                <td id="select">
                                    <form action="" method="POST" class="test">
                                        <input type="hidden" name="customer_id" id="customer_id{{$customer->id}}" value="{{$customer->id}}">
                                        <select name="repeater" id="select{{$customer->id}}"  class="form-control form-control-user @error('repeater') is-invalid @enderror">
                                            <option selected disabled value="">إاختر...</option>
                                            <option  value="true">مقبول</option>
                                            <option  value="false">مرفوض</option>

                                        </select>
                                        @error('repeater')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </form>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">لا يوجد بيانات</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{ $customers->links() }}
                </div>
            </div>
        </div>

    </div>



@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            let customers = {!! $customers->toJson() !!};

            $(".test").each(function(index) {
                $(document).on('change', '#select'+customers.data[index].id, function(e) {
                    let repeater = $(this).val();
                    let customer_id = customers.data[index].id;
                    if (confirm('هل تريد تغيير حالة العميل؟')){
                        $.ajax({
                            url: "{{ route('customers.change.follow') }}",
                            method: 'POST',
                            data: {
                                repeater: repeater,
                                customer_id: customer_id,
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    location.reload();
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>

@endsection
