@foreach ($stores as $store)

    <div class="modal fade" id="deleteModal{{$store->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalExample">هل تريد حذف المنتج؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body text-right">اختر "حذف" بالأسفل اذا كنت تريد حذف. <span class="text-danger">{{$store->prodcut_name}}</span> المنتج!.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('store-delete-form{{$store->id}}').submit();">
                        حذف
                    </a>
                    <form id="store-delete-form{{$store->id}}" method="POST" action="{{ route('stores.destroy', ['store' => $store->id]) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


