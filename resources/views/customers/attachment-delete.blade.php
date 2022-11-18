@foreach ($customer->attachments as $attachment)

    <div class="modal fade" id="deleteModal{{$attachment->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalExample">هل تريد حذف المرفق؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">اختر "حذف" بالأسفل اذا كنت تريد حذف. <span class="text-danger">{{$attachment->title}}</span> المرفق! </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('attachment-delete-form{{$attachment->id}}').submit();">
                        حذف
                    </a>
                    <form id="attachment-delete-form{{$attachment->id}}" method="POST"
                          action="{{ route('customers.attachment.destroy', ['attachment' => $attachment->id]) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

