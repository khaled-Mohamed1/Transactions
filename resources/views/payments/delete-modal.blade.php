@foreach ($customer->payments as $payment)

    <div class="modal fade" id="deleteModal{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalExample">هل تريد حذف دفعة العميل؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">اختر "حذف" بالأسفل اذا كنت تريد حذف.<span class="text-danger">{{$payment->payment_NO}}</span> الدفعة!.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('payment-delete-form{{$payment->id}}').submit();">
                        حذف
                    </a>
                    <form id="payment-delete-form{{$payment->id}}" method="POST" action="{{ route('payments.destroy', ['payment' => $payment->id]) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

