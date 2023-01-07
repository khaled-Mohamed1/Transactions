
    <div class="modal fade" id="ratifyModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
         aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalExample">هل تريد تصديق رقم القضية {{$issue->issue_NO}}؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body text-right">
                    <form id="issue-ratify-form" method="POST" action="{{route('issues.export.WORD.ratify',['issue'=>$issue->id])}}">
                        @csrf
                        <div class="row">
                            {{-- customer_id --}}
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>اسم العميل <span style="color:red;">*</span></label>
                                <select name="customer_id" style="height: 45px;" class="form-control form-control-user @error('customer_id') is-invalid @enderror">
                                    <option selected disabled value="">اختر...</option>
                                    @foreach($issue->customerIssues as $customer)
                                        <option value="{{ $customer->IssueCustomer->id }}">{{ $customer->IssueCustomer->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- payment_type --}}
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>نوع الدفع <span style="color:red;">*</span></label>
                                <select name="payment_type" id="payment_type" style="height: 45px;" class="form-control form-control-user @error('payment_type') is-invalid @enderror">
                                    <option selected disabled value="">اختر...</option>
                                    <option value="استقطاع">استقطاع</option>
                                    <option value="ربع راتب">ربع راتب</option>
                                </select>
                                @error('payment_type')
                                <span class="text-payment_type">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>بنك طالب التنفيذ <span style="color:red;">*</span></label>
                                <select name="bank_id" style="height: 45px;" class="form-control form-control-user @error('bank_id') is-invalid @enderror">
                                    <option selected disabled value="">اختر...</option>
                                    @foreach($issue->execution_request_idIssue->agentBanks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->AgentBank->name }}</option>
                                    @endforeach
                                </select>
                                @error('bank_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- payment_type --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <label>لدى <span style="color:red;">*</span></label>
                                <select name="by" id="payment_type" style="height: 45px;" class="form-control form-control-user @error('by') is-invalid @enderror">
                                    <option selected disabled value="">اختر...</option>
                                    <option value="تأمين معاشات">تأمين معاشات</option>
                                    <option value="المالية العسكرية">المالية العسكرية</option>
                                    <option value="البريد">البريد</option>
                                    <option value="بنك">بنك</option>
                                </select>
                                @error('by')
                                <span class="text-payment_type">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0" style="display: none" id="currency_type">
                                <label>نوع العملة <span style="color:red;">*</span></label>
                                <select name="currency_type" style="height: 45px;" class="form-control form-control-user @error('currency_type') is-invalid @enderror">
                                    <option selected disabled value="">اختار...</option>
                                    <option value="شيكل" {{ old('currency_type') == 'شيكل' ? 'selected' : '' }}>شيكل</option>
                                    <option value="دولار" {{ old('currency_type') == 'دولار' ? 'selected' : '' }}>دولار</option>
                                    <option value="دينار" {{ old('currency_type') == 'دينار' ? 'selected' : '' }}>دينار</option>
                                </select>

                                @error('currency_type')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- case_amount --}}
                            <div class="col-sm-12 mb-3 mt-3 mb-sm-0" style="display: none" id="withholding_amount">
                                <label>مبلغ الاستقطاع <span style="color:red;">*</span></label>
                                <input
                                    style="height: 45px;"
                                    type="number"
                                    min="1"
                                    class="form-control form-control-user @error('withholding_amount') is-invalid @enderror"
                                    name="withholding_amount">

                                @error('withholding_amount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                            {{-- payment_type --}}
{{--                            <div class="col-sm-12 mb-3 mt-3 mb-sm-0">--}}
{{--                                <label>نوع <span style="color:red;">*</span></label>--}}
{{--                                <select name="type" style="height: 45px;" class="form-control form-control-user @error('type') is-invalid @enderror">--}}
{{--                                    <option selected disabled value="">اختر...</option>--}}
{{--                                    <option value="بنك">بنك</option>--}}
{{--                                    <option value="هيئة تأمين والمعاشات">تأمين</option>--}}
{{--                                </select>--}}
{{--                                @error('type')--}}
{{--                                <span class="text-payment_type">{{$message}}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <a class="btn btn-success" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('issue-ratify-form').submit();">
                        تصديق
                    </a>

                </div>
            </div>
        </div>
    </div>


    @section('scripts')

        <script type="text/javascript">
            $(document).ready(function() {
                $("#payment_type").change(function(){

                    if ($(this).val() == 'استقطاع') {
                        $("#withholding_amount").show().siblings();
                        $("#currency_type").show().siblings();
                    } else {
                        $("#withholding_amount").hide();
                        $("#currency_type").hide();
                    }

                });


            });
        </script>

    @endsection

