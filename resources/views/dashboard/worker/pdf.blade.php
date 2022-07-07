<!DOCTYPE html>
<html>

<head>
    <style>
        *{
            text-align: center
        }
        table,
        th,
        td {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <h5>العاملات</h5>

    <table class="container" style="width: 100%;">
        <thead>
            <tr>
                <th>
                    <h5>اسم العاملة</h5>
                </th>
                <th>
                    <h5> مكتب الاستقدام</h5>
                </th>
                <th>
                    <h5>الجنسية</h5>
                </th>
                <th>
                    <h5>الحالة</h5>
                </th>
                <th>
                    <h5>العمر</h5>
                </th>
                <th>
                    <h5>الخبرة</h5>
                </th>
                <th>
                    <h5>اللغات</h5>
                </th>
                <th>
                    <h5>الديانة</h5>
                </th>

                <th>
                    <h5>المدينة</h5>
                </th>

            </tr>
        </thead>
        <tbody>

            @foreach ($workers as $worker)
                <tr>
                    <td>{{ $worker->name }}</td>
                    <td>{{ $worker->company->name }}</td>
                    <td>{{ $worker->natonality->name }}</td>
                    <td> {{ worker_status($worker->status) }}</td>
                    <td> {{ $worker->age }}</td>
                    <td>{{ $worker->experience }}</td>
                    <td> {{ $worker->language }}</td>
                    <td>{{ $worker->religion }}</td>

                    <td> {{ $worker->city }}</td>

                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
