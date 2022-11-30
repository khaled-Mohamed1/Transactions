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
                            <th width="15%">إنشاء بواسطة</th>
                            <th width="10%">نوع المستند</th>
                            <th width="10%">عدد المستند</th>
                            <th width="20%">الأطراف</th>
                            <th width="10%">عدد القضايا</th>
                            <th width="10%">العمليات</th>
                            @hasrole('Admin')
                            <th width="15%">إضافة إلى</th>
                            @endhasrole

                            @hasrole('المدير العام')
                            <th width="15%">إضافة إلى</th>
                            @endhasrole
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($drafts as $draft)
                            <tr>
                                <td><a href="{{route('drafts.show',['draft' => $draft->id])}}">{{ $draft->draft_NO }}</a></td>
                                <td>{{ $draft->UserDraft->full_name }}</td>
                                <td>{{ $draft->document_type }}</td>
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
                                    <form action="" method="POST" class="test">
                                        <input type="hidden" name="customer_id" id="customer_id{{$draft->id}}" value="{{$draft->id}}">
                                        <select name="user_id" id="select{{$draft->id}}"  class="form-control form-control-user @error('user_id') is-invalid @enderror">
                                            <option  value="false">إلغاء</option>
                                            @foreach($users as $user)
                                                <option id="option{{$draft->id}}" value="{{$user->id}}" {{old('user_id') ? ((old('user_id') == $user->id) ? 'selected' : '')
                                                : (($user->id == $draft->updated_by) ? 'selected' : '')}}>{{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </form>
                                </td>
                                @endhasrole
                                @hasrole('المدير العام')
                                <td>
                                    <form action="" method="POST" class="test">
                                        <input type="hidden" name="customer_id" id="customer_id{{$draft->id}}" value="{{$draft->id}}">
                                        <select name="user_id" id="select{{$draft->id}}"  class="form-control form-control-user @error('user_id') is-invalid @enderror">
                                            <option  value="false">إلغاء</option>
                                            @foreach($users as $user)
                                                <option id="option{{$draft->id}}" value="{{$user->id}}" {{old('user_id') ? ((old('user_id') == $user->id) ? 'selected' : '')
                                                : (($user->id == $draft->updated_by) ? 'selected' : '')}}>{{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </form>
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

            let drafts = {!! $drafts->toJson() !!};

            $(".test").each(function(index) {
                $(document).on('change', '#select'+drafts.data[index].id, function(e) {
                    let user_id = $(this).val();
                    let customer_id = drafts.data[index].id;
                    if (confirm('هل تريد اضافة المهمة للموظف؟')){
                        $.ajax({
                            url: "{{ route('drafts.add.task') }}",
                            method: 'POST',
                            data: {
                                user_id: user_id,
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

