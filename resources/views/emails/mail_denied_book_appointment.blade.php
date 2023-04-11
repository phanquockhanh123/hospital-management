<div>
    Thân gửi qúy khách hàng {{ $patientName }},
</div>
<div>
    Phòng khám đa khoa vừa ghi nhận được yêu cầu đặt lịch của quý khách. Theo như thông tin phòng khám nhận được,
     trong khoảng thời gian 1 tiếng khoảng thời gian quý khách mong muôn, phòng <b>{{ $doctorDepatment }}</b> bận. Chúng tôi
     xin được chuyển thời gian sang khoảng thời gian khác.Thông tin như sau:
</div>
<div>
    - Mã bệnh nhân : {{ $patientCode}} <br/>
    - Bác sĩ chịu trách nhiệm: {{ $doctorName }} <br/>
    - Phòng khám: {{ $doctorDepatment }} <br/>
    - Thời gian thăm khám bắt đầu từ: {{ $startDate }}
    - Thời gian thăm khám kết thúc: {{ $endDate }} 
</div>
<div>
    Cảm ơn qúy khách. Rất mong nhận được phản hồi lại từ quý khách!
</div>