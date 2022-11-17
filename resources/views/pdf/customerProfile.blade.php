<!doctype html>
<html dir="rtl" lang="ar">

<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        table {
            font-size: 12px;
            border: black solid 1px;
        }

         body { font-family: DejaVu Sans, sans-serif;font-weight: 400; direction: rtl }
    </style>
</head>

<body>
<div class="row" style="position: relative">
    <div class="col-8" style="position: absolute; top: 0; right: 0">
        <table class="table table-bordered mt-5 text-right">
            <thead>
            <tr>
                <th colspan="3">{{$data->full_name}}</th>
                <th>الأسم رباعي</th>
            </tr>
            <tr>
                <th>{{$data->ID_NO}}</th>
                <th>رقم الهوية</th>
                <th>{{$data->customer_NO}}</th>
                <th>رقم الاستدلالي</th>
            </tr>
            <tr>
                <th>{{$data->phone_NO}}</th>
                <th>جوال</th>
                <th>{{$data->reserve_phone_NO}}</th>
                <th>رقم بديل</th>
            </tr>
            <tr>
                <th>{{$data->job}}</th>
                <th>العمل</th>
                <th>{{$data->bank_name}}</th>
                <th>البنك</th>
            </tr>
            <tr>
                <th>{{$data->bank_branch}}</th>
                <th>الفرع</th>
                <th>{{$data->bank_account_NO}}</th>
                <th>رقم الحساب</th>
            </tr>
            <tr>
                <th></th>
                <th>رقم القضية</th>
                <th></th>
                <th>محكمة</th>
            </tr>
            <tr>
                <th></th>
                <th>استدلال جماعي</th>
                <th>{{$data->region}}</th>
                <th>المحافظة</th>
            </tr>
            <tr>
                <th colspan="3">{{$data->address}}</th>
                <th>العنوان</th>
            </tr>
            <tr>
                <th height="150px" colspan="3">{{$data->notes}}</th>
                <th height="150px">ملاحظات</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="col-3">
        <table class="table table-bordered mt-5 text-right">
            <thead>
            <tr>
                <th>{{$data->customer_NO}}</th>
                <th>رقم الاستدلالي</th>
            </tr>
            </thead>
        </table>
    </div>

</div>
</body>

</html>


@section('scripts')

@endsection


