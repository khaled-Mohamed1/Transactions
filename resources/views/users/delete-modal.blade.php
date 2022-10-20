<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalExample">هل تريد حذف الموظف؟</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body text-right">اختر "حذف" بالأسفل اذا كنت تريد حذف الموظف.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                <a class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                    حذف
                </a>
                <form id="user-delete-form" method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>
