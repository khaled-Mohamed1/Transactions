{{-- Message --}}
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible text-right" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>بنجاح !</strong> {{ session('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible text-right" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>فشل !</strong> {{ session('error') }}
    </div>
@endif
