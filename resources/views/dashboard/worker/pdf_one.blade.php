<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML invoice template</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="https://workers.foryougo.net/uploads/general/PwsoWpkahkzTTiLtkFQRKzwOLPCKs1Uo7BTwjtt3.jpg" width="150" height="100"  />
								</td>

								
							</tr>
						</table>
					</td>
				</tr>

	

				<tr class="heading">

					<td></td>
					<td>بيانات العاملة</td>

				</tr>

				<tr class="details">
					<td>{{ $worker->name }}</td>

					<td>اسم العاملة</td>
				</tr>
				<tr class="details">
					<td>{{ @$worker->company->name }}</td>

					<td>اسم مكتب الاستقدام</td>
				</tr>
				<tr class="details">
					<td>{{ $worker->natonality->title }}</td>

					<td>الجنسية  </td>
				</tr>
				<tr class="details">
					<td>{{ $worker->age }}</td>

					<td>العمر   </td>
				</tr>
				<tr class="details">
					<td>{{ $worker->experience }}</td>

					<td>عدد سنوات الخبرة  </td>
				</tr>
                <tr class="details">
					<td>{{  $worker->in_sa == 1  ?'yes' : 'no'}}</td>

					<td>هل الخبرات داخل السعودية ام لا?    </td>
				</tr>
                @php
                    $langs=  json_decode($worker->language);
                $array = array();
                foreach($langs as $a){
                    array_push($array,trans($a));
                }
                            @endphp
                <tr class="details">
                    
					<td>{!! json_encode($array) !!}</td>

					<td>اللغات</td>
				</tr>

                <tr class="details">
					<td>{{  $worker->religion}}</td>

					<td>الديانة</td>
				</tr>
                <tr class="details">
					<td>{{  $worker->approve_chiled == 1  ?'yes' : 'no'}}</td>

					<td>هل تتقبل الأطفال</td>
				</tr>
                <tr class="details">
					<td>{{  $worker->is_coocked == 1  ?'yes' : 'no'}}</td>

					<td>هل تجيد الطهي ?</td>
				</tr>
                <tr class="details">
					<td>{{   $worker->city}}</td>

					<td>المدينة</td>
				</tr>
		
			</table>
		</div>
	</body>
</html>