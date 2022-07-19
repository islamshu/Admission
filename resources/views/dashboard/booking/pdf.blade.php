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
    <h5>الحجوزات</h5>

    <table class="container" style="width: 100%;">
        <thead>
            <tr>
                <th>
                    <h5>رقم الطلب</h5>
                </th>
<th>
                    <h5>اسم العميل </h5>
                </th>
<th>
                    <h5>اسم العاملة</h5>
                </th>
<th>
                    <h5>رقم الهاتف</h5>
                </th>
                <th>
                    <h5>{{ __('Created at') }} </h5>
                </th>      
<th>
                    <h5>تاريخ الميلاد</h5>
                </th>
<th>
                    <h5>الحالة</h5>
                </th>
<th>
                    <h5>رقم الهوية الخاص بالعميل</h5>
                </th>
<th>
                    <h5>رقم الجواز او الاقامة</h5>
                </th>
{{-- <th>
                    <h5>صورة الفيزا</h5>
                </th> --}}


            </tr>
        </thead>
        <tbody>

            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->order_id }}</td>
                    <td>{{   $booking->name}}</td>
                    <td>{{  $booking->worker->name }}</td>
                    <td> {{  $booking->phone }}</td>
                    <td> {{$booking->DOB }}</td>
                    <td>{{$booking->created_at->format('Y-m-d') }}</td>
                    <td> {{ booking_status($booking->status) }}</td>
                    <td>{{  $booking->id_number }}</td>

                    <td> {{ $booking->visa_number }}</td>
                    {{-- <td>{{  asset('uploads/'.$booking->visa_image) }}</td> --}}


                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
