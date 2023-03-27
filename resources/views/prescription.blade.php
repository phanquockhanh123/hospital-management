<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Đơn thuốc</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		h1 {
			text-align: center;
			margin-top: 20px;
		}
		table {
			border-collapse: collapse;
			width: 80%;
			margin: 20px auto;
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
		.patient-info label {
			font-weight: bold;
			display: inline-block;
			width: 100px;
		}
		.patient-info span {
			display: inline-block;
			width: calc(100% - 100px);
		}
	</style>
</head>
<body>
	<h1>Đơn thuốc</h1>
	<div class="patient-info">
        <div>
			<label>Mã bệnh nhân:</label>
			<span>{{ $prescription->patient->patient_code }}</span>
		</div>
		<div>
			<label>Tên bệnh nhân:</label>
			<span>{{ $prescription->patient->name }}</span>
		</div>
		<div>
			<label>Ngày sinh:</label>
			<span>{{ $prescription->patient->date_of_birth }}</span>
		</div>
		<div>
			<label>Giới tính:</label>
			<span>
                @if($prescription->patient->gender == 0)
                    Nam
                @else 
                    Nữ
                @endif
            </span>
		</div>
		<div>
			<label>Số điện thoại:</label>
			<span>{{ $prescription->patient->phone }}</span>
		</div>
		<div>
			<label>Địa chỉ:</label>
            <span>{{ $prescription->patient->address }}</span>
		</div>
        <div>
			<label>Bệnh chính:</label>
            <span>{{ $prescription->main_disease }}</span>
		</div>
        <div>
			<label>Bệnh phụ:</label>
            <span>{{ $prescription->side_disease }}</span>
		</div>
	</div>
	<table>
		<thead>
			<tr>
				<th>Tên thuốc</th>
				<th>Hàm lượng</th>
                <th>Lưu ý</th>
				<th>DVT</th>
                <th>Số lượng</th>
			</tr>
		</thead>
		<tbody>
            @foreach($preItem as $val)
			<tr>
				<td>{{ $val['medical_name'] }}</td>
				<td>{{ $val['dosage'] }}</td>
				<td>{{ $val['dosage_note'] }}</td>
                <td>{{ $val['unit'] }}</td>
                <td>{{ $val['amount'] }}</td>
			</tr>
            @endforeach
		</tbody>
	</table>
</body>
</html>