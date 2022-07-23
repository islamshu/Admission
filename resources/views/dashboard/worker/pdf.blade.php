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
        
    
   

        <th style="width: 10%">
            الديانة
    </th>

    <th style="width: 17%">
        اللغات
    </th>
    <th style="width: 9%">
        خبرة
    </th>
    <th style="width: 9%">
        العمر
    </th>
    <th style="width: 12%">
        الحالة
    </th>
    <th style="width: 11%">
        الجنسية
    </th>
    <th style="width: 10%">
        اسم المكتب
   </th>
   <th style="width: 10%">
    اسم العاملة
</th>

    

  </tr>
  @foreach ($workers as $worker)
  <tr>
      
      <td style="text-align: right">{{ __($worker->religion) }}</td>
      <td style="text-align: right"> {{ (get_lang_worker( $worker->language))  }}</td>
      <td style="text-align: right">{{ $worker->experience }} </td>
      <td style="text-align: right"> {{ $worker->age }} </td>
      <td style="text-align: right"> {{ worker_status($worker) }}</td>
      <td style="text-align: right">{{ $worker->natonality->name }}</td>
      <td style="text-align: right">{{ $worker->company->name }}</td>
      <td style="text-align: right">{{ $worker->name }}</td>

  </tr>
@endforeach
 
 
</table>
<br>



</body>
</html>