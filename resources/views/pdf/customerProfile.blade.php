<!doctype html>
<html dir="rtl" lang="en">

<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        table {
            font-size: 12px;
        }

         body { font-family: DejaVu Sans, sans-serif; direction: rtl }
    </style>
</head>

<body>
<div class="row" dir="rtl">
    <div class="col-8">
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
            </thead>
        </table>
    </div>

    <div class="col-4">
        <table class="table table-bordered mt-5 text-right">
            <thead>
            <tr>
                <th>رقم الاستدلالي</th>
                <th>{{$data->customer_NO}}</th>
            </tr>
            </thead>
        </table>
    </div>

</div>
</body>

</html>


