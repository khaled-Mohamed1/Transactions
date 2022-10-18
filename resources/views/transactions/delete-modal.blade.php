@foreach ($transactions as $transaction)

    <div class="modal fade" id="deleteModal{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalExample">Are you Sure You wanted to Delete?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" below if you want to delete <span class="text-danger">{{$transaction->full_name}}</span> Transaction!.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('transaction-delete-form{{$transaction->id}}').submit();">
                        Delete
                    </a>
                    <form id="transaction-delete-form{{$transaction->id}}" method="POST" action="{{ route('transactions.destroy', ['transaction' => $transaction->id]) }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

