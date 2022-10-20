@foreach ($customers as $customer)

    <div class="modal fade" id="deleteModal{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalExample">هل تريد حذف العميل؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">اختر "حذف" بالأسفل اذا كنت تريد حذف.<span class="text-danger">{{$customer->full_name}}</span> العميل!.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('customer-delete-form{{$customer->id}}').submit();">
                        حذف
                    </a>
                    <form id="customer-delete-form{{$customer->id}}" method="POST" action="{{ route('customers.destroy', ['customer' => $customer->id]) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

