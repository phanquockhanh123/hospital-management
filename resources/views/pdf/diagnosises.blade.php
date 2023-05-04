<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Đơn thuốc</title>
	<style>
		body {
			font-family: DejaVu Sans, sans-serif;
			margin: 0;
			padding: 0;
		}
		h1 {
			text-align: center;
			margin-top: 50px;
			margin-bottom: 30px;
			font-size: 35px;
		}
		h4 {
			margin-top: 280px;
		}
		table {
			border-collapse: collapse;
			width: 80%;
			margin: 10px auto;
		}
		th, td {
			padding: 10px;
			text-align: center;
		}
		th {
			background-color: #e8e8e8;
		}
		.patient-info {
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			justify-content: center;
			margin-bottom: 20px;
		}
		.patient-info div {
			margin: 5px;
			flex: 1;
		}
		.title {
			max-width: 650px;
			text-align: center;
			align-content: center;
		}
		.title1 {
			font-weight: bold;
			font-size: 25px;

		}
		.title2 {
			font-weight: bold;
			font-size: 20px;

		}
		.title3 {
			float: right;

		}
		.patient-info label {
			font-weight: bold;
			display: inline-block;
			width: 150px;
		}
		.patient-info span {
			display: inline-block;
			width: calc(100% - 100px);
		}
		.footer {
			float: right;
			text-align: center;
			align-content: center;
		}
		.sign {
			margin-top: 20px;
			margin-bottom: 40px;
		}
		.phone {
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="title">
		<div class="title1">PHÒNG KHÁM ĐA KHOA AN KHANG</div>
		<div class="title2">ĐC: QL45, Xuân Khang, Như Thanh, Thanh Hoá</div>
		<div class="phone">Điện thoại: 0327018337</div>
		<div class="title3">{{ $diagnosis->doctor->doctorDepartment->name }}</div>
	</div>
	<h1>ĐƠN XÉT NGHIỆM</h1>
	<div class="patient-info">
        <div>
			<label>Mã bệnh nhân:</label>
			<span>{{ $diagnosis->patient->patient_code }}</span>
		</div>
		<div>
			<label>Họ tên:</label>
			<span>{{ $diagnosis->patient->name }}</span>
		</div>
		<div>
			<label>Ngày sinh:</label>
			<span>{{ $diagnosis->patient->date_of_birth->format(config('const.format.date')) }}</span>
		</div>
		<div>
			<label>Giới tính:</label>
			<span>
                @if($diagnosis->patient->gender == 0)
                    Nam
                @else 
                    Nữ
                @endif
            </span>
		</div>
		<div>
			<label>Số điện thoại:</label>
			<span>{{ $diagnosis->patient->phone }}</span>
		</div>
		<div>
			<label>Địa chỉ:</label>
            <span>{{ $diagnosis->patient->address }}</span>
		</div>
        <div>
			<label>Chẩn đoán bệnh chính:</label>
            <span>{{ $diagnosis->main_diagnosis }}</span>
		</div>
        <div>
			<label>Chẩn đoán bệnh phụ:</label>
            <span>{{ $diagnosis->side_diagnosis }}</span>
		</div>
	</div>
	<table>
		<thead>
			<tr>
                <th scope="col">TÊN XN</th>
                <th scope="col">KẾT QUẢ</th>
                <th scope="col">THAM CHIẾU</th>
                <th scope="col">ĐƠN VỊ</th>
                <th scope="col">PHƯƠNG THỨC</th>
                <th scope="col">LƯU Ý</th>
			</tr>
		</thead>
		<tbody>
            @foreach($diaPre as $val)
			<tr>
				<td>{{ $services->where('id', $val['service_id'])->first()->service_name }}</td>
				<td>{{ $val['result'] }}</td>
				<td>{{ $val['references_range'] }}</td>
                <td>{{ $val['unit'] }}</td>
                <td>{{ $val['method'] }}</td>
                <td>{{ $val['diagnosis_note'] }}</td>
			</tr>
            @endforeach
		</tbody>
	</table>
	<div class="note">
		Lời dặn: {{ $diagnosis->note }}
	</div>
	<div class="footer">
		<div class="created_at">Ngày {{ $diagnosis->updated_at->day }} tháng {{ $diagnosis->updated_at->month }} năm {{ $diagnosis->updated_at->year }}</div>
		<h3>BÁC SĨ KHÁM, CHỮA BệNH</h3>
		<div class="sign">(Kỹ, ghi rõ họ tên)</div>
		<h2>{{ $diagnosis->doctor->name }}</h2>
	</div>
	<h4>Vui lòng mang theo toa khi tái khám</h4>
</body>
</html>