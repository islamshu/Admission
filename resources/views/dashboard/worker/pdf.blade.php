<!DOCTYPE html>
<html>
<head>
<style>
    *{
        direction: rtl
    }
table {
  width:100%;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
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
.center{
    text-align: center
}
</style>
</head>
<body>

<h2 class="center">	<img src="https://workers.foryougo.net/uploads/general/PwsoWpkahkzTTiLtkFQRKzwOLPCKs1Uo7BTwjtt3.jpg" width="150" height="100"  /></h2>
<h2 class="center">العاملات</h2>
<table id="t01">
    <tr>
        
    
    <th>
        المدينة
    </th>

    <th>
        الديانة
    </th>

    <th>
        اللغات
    </th>
    <th>
        الخبرة
    </th>
    <th>
        العمر
    </th>
    <th>
        الحالة
    </th>
    <th>
        الجنسية
    </th>
    <th>
        مكتب الاستقدام
   </th>
   <th>
    اسم العاملة
</th>

    

  </tr>
  @foreach ($workers as $worker)
  <tr>
      
      <td> {{ $worker->city }}</td>
      <td>{{ __($worker->religion) }}</td>
      <td> {{ (get_lang_worker( $worker->language))  }}</td>
      <td>{{ $worker->experience }} {{ trans(' years') }}</td>
      <td> {{ $worker->age }} {{ trans(' years') }}</td>
      <td> {{ worker_status($worker) }}</td>
      <td>{{ $worker->natonality->name }}</td>
      <td>{{ $worker->company->name }}</td>
      <td>{{ $worker->name }}</td>

  </tr>
@endforeach
 
 
</table>
<br>



</body>
</html>