@include('user.header')

<div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1>Liên hệ</h1>

                <div class="title">
                    <p style="color: black;">Với mong muốn mang những dịch vụ y tế chất lượng cao tới gần hơn tới người dân thủ đô và các tỉnh lân cận, 
                     cơ sở của Hệ thống Phòng Khám An Khang  được đặt tại những vị trí đắc địa và thuận lợi giao thông,
                     không chỉ đối với khách hàng tại Thanh hóa mà ngay cả khách hàng từ các tỉnh cũng rất dễ dàng đi lại và tìm kiếm.</p>
                     <br>
                     <p style="color: black">Với vị trị đắc địa, các không gian của bệnh viện đều có view Hồ sang chảnh, giúp người bệnh có trải nghiệm thăm khám và điều trị như đi nghỉ dưỡng.</p>

                     <div class="row">
                        <div class="col-sm">
                            <b>Thông tin liên hệ:</b><br>
                            <b>BỆNH VIỆN ĐA KHOA AN KHANG</b><br>
                            <p style="color: black;">Địa chỉ: QL45, Xuân Khang, Như Thanh, Thanh Hoá<br>
                            Cấp cứu (24/24): 0901 793 122<br>
                            Liên hệ: 1900 5588 92 hoặc 0936 388 288 đặt lịch khám<br>
                            Hotline giao thuốc tận nhà: 0936347266<br>

                            <b>Giờ làm việc:</b><br/>
                            Từ Thứ 2 – Chủ nhật: 7h00 – 17h00<br>
                            Phòng khám nội tổng hợp : 8h00 – 17h00<br>
                            Phòng khám chuyên khoa ngoại: 7h30 – 20h00<br>
                            Phòng khám chuyên khoa nội: 8h00 – 17h00<br>
                            Phòng khám chuyên khoa răng-hàm-mặt: 8h00 – 17h00<br>
                            Phòng khám chuyên khoa tai-mũi-họng: 8h00 – 17h00<br>
                        </div>
                        <div class="col-sm">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d234.813370985976!2d105.53426471069368!3d19.66941083988365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3136e242a1c2c51d%3A0x8b018096fbf69b7d!2zUGjDsm5nIEtow6FtIMSQYSBLaG9hIEFuIEtoYW5n!5e0!3m2!1svi!2s!4v1683126902676!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                     </div>
                </div>
            </div>
            <div class="col-sm-4" style="border:1px solid orange">
                <h3 style="text-align: center;margin-top:20px;color:#00D9A5">TIN TỨC MỚI</h3>
                <hr>
                <div class="list-news">
                    <ul>
                        @foreach ($news as $new)
                            <li style="text-decoration: none; list-style:none;margin-bottom: 30px;">
                                <a href="#" >
                                    <div class="row">
                                        <div class="col-sm" >
                                            <img src="./imgNews/{{ $new->filename}}" style="border-radius:10px;vertical-align: middle;
                                                        width: 120px;height: 80px;" alt="" title="">
                                        </div>
                                        <div class="col-sm">
                                            {{ $new->title }}
                                        </div>
                                    </div>
                                </a>
                                {{-- <div class="content">
                                    {{ $new->content }}
                                </div> --}}
                                
                            </li>
                        @endforeach
                    </ul>
                   
                </div>
            </div>
        </div>
        
    </div>
</div>
@include('user.footer')