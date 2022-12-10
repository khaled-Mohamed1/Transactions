
<div class="modal fade" id="conversionModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
     aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalExample">هل تريد تحويل وصرف رقم القضية {{$issue->issue_NO}}؟</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body text-right">
                <form id="issue-conversion-form" method="POST" action="{{route('issues.export.WORD.conversion',['issue'=>$issue->id])}}">
                    @csrf
                    <div class="row">

                        {{-- customer_id --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>اسم العميل <span style="color:red;">*</span></label>
                            <select name="agent_id" style="height: 45px;" class="form-control form-control-user @error('customer_id') is-invalid @enderror">
                                <option selected disabled value="">اختر...</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->agent_name }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <label>بنك طالب التنفيذ <span style="color:red;">*</span></label>
                            <select name="bank_id" style="height: 45px;" class="form-control form-control-user @error('bank_id') is-invalid @enderror">
                                <option selected disabled value="">اختر...</option>
                                @foreach($issue->execution_request_idIssue->agentBanks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                @endforeach
                            </select>
                            @error('bank_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                <a class="btn btn-success" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('issue-conversion-form').submit();">
                    تحويل
                </a>

            </div>
        </div>
    </div>
</div>



