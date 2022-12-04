
<div class="modal fade" id="reimbursementModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
     aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalExample">هل تريد تسديد رقم القضية {{$issue->issue_NO}}؟</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body text-right">
                <form id="issue-reimbursement-form" method="POST" action="{{route('issues.export.WORD.reimbursement',['issue'=>$issue->id])}}">
                    @csrf
                    <div class="row">

                        {{-- customer_id --}}
                        <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
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

                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                <a class="btn btn-success" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('issue-reimbursement-form').submit();">
                    تسديد
                </a>

            </div>
        </div>
    </div>
</div>



