<!DOCTYPE html>
<html>

<head>
    <style>
        * {
            direction: rtl
        }

        table {
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        table#t01 tr:nth-child(even) {
            background-color: #eee;
        }

        table#t01 tr:nth-child(odd) {
            background-color: #fff;
        }

        table#t01 th {
            background-color: black;
            color: white;
        }

        .center {
            text-align: center
        }
    </style>
</head>

<body>

    <h2 class="center"> <img
            src="https://workers.foryougo.net/uploads/general/PwsoWpkahkzTTiLtkFQRKzwOLPCKs1Uo7BTwjtt3.jpg" width="150"
            height="100" /></h2>
    <h2 class="center">الحجوزات</h2>

    <table id="t01">
        <thead>
            <tr>
                
               
                
               
               
                
                
                {{-- <th>
                    محذوف ؟  
              </th> --}}
                

                <th>
                      رقم الجواز 
                </th>
                <th>
                    رقم هوية العميل  
                </th>
                <th>
                    الحالة
                </th>
                <th>
                    تاريخ الميلاد
                </th>
                <th>
                    {{ __('Created at') }} 
                </th>
                <th>
                    رقم الهاتف
                </th>
                <th>
                    اسم العاملة
                </th>
                <th>
                    اسم العميل 
                </th>
                <th>
                    رقم الطلب
                </th>
                


            </tr>
        </thead>
        <tbody>

            @foreach ($bookings as $booking)
                <tr>

                    {{-- <td>{{$booking->deleted_at == null  ? 'لا' : 'نعم'}}</td> --}}

                    <td> {{ $booking->visa_number }}</td>
                    <td>{{ $booking->id_number }}</td>
                    <td> {{ booking_status($booking->status) }}</td>
                    <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                    <td> {{ $booking->DOB }}</td>
                    <td> {{ $booking->phone }}</td>
                    <td>{{ @$booking->worker->name }}</td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->order_id }}</td>


                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
