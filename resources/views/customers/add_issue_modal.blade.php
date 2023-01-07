<div class="modal fade" id="addIssueModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalExample">هل تريد اضافة المهمة للموظف؟</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body text-right">اختر "اضافة" بالأسفل اذا كنت تريد اضافة
                <span class="text-danger"></span> قضية للموظف!
                <form id="issue-add-form" method="POST" action="{{route('customers.add.task.issue',['customer' => $customer->id])}}">

                    <div class="mb-3 mt-3 mb-sm-0">
                        <select name="user_id" class="form-control form-control-user @error('user_id') is-invalid @enderror">
                            <option value="false">إلغاء</option>
                            @foreach($users_issues as $user)
                                <option value="{{$user->id}}" {{old('user_id') ? ((old('user_id') == $user->id) ? 'selected' : '')
                                                                    : (($user->id == $customer->updated_issue_by) ? 'selected' : '')}}>{{$user->full_name}}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="mb-3 mt-3 mb-sm-0">
                        <label>الملاحظات </label>
                        <textarea class="form-control form-control-user"
                                  name="notes" rows="3">{{$customer->notes}}</textarea>
                    </div>
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('issue-add-form').submit();">
                    اضافة
                </a>

            </div>
        </div>
    </div>
</div>


