@foreach ($issues as $issue)

    <div class="modal fade" id="deleteModal{{$issue->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalExample">هل تريد حذف القضية؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body text-right">اختر "حذف" بالأسفل اذا كنت تريد حذف. <span class="text-danger">{{$issue->issue_NO}}</span> القضية!.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('issue-delete-form{{$issue->id}}').submit();">
                        حذف
                    </a>
                    <form id="issue-delete-form{{$issue->id}}" method="POST" action="{{ route('issues.destroy', ['issue' => $issue->id]) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


