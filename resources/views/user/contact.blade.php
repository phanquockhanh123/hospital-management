@include('user.header')

<div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1>Liên hệ</h1>

                <div class="title">
                    <p style="color: black;">Với mong muốn mang những dịch vụ y tế chất lượng cao tới gần hơn tới người dân thủ đô và các tỉnh lân cận, 
                    3 cơ sở của Hệ thống Phòng Khám An Khang  được đặt tại những vị trí đắc địa và thuận lợi giao thông,
                     không chỉ đối với khách hàng tại Hà Nội mà ngay cả khách hàng từ các tỉnh cũng rất dễ dàng đi lại và tìm kiếm.</p>
                     <br>
                     <p style="color: black">Vị trí nằm bên cạnh Hồ Tây thoáng mát, các không gian của bệnh viện đều có view Hồ sang chảnh, giúp người bệnh có trải nghiệm thăm khám và điều trị như đi nghỉ dưỡng.</p>

                     <div class="row">
                        <div class="col-sm">
                            <b>Thông tin liên hệ:</b><br>
                            <b>BỆNH VIỆN ĐA KHOA QUỐC TẾ AN KHANG</b><br>
                            <p style="color: black;">Địa chỉ: 286 Thụy Khuê, Tây Hồ, Hà Nội<br>
                            Cấp cứu (24/24): 0901 793 122<br>
                            Trực sản (24/24): 0936 245 499<br>
                            Liên hệ: 1900 5588 92 hoặc 0936 388 288 đặt lịch khám<br>
                            Hotline giao thuốc tận nhà: 0936347266<br>

                            <b>Giờ làm việc:</b><br/>
                            Từ Thứ 2 – Chủ nhật: 7h00 – 17h00<br>
                            Khám Nội – Đa khoa: 7h00 – 17h00<br>
                            Khám Ngoại: 8h00 – 17h00<br>
                            Khoa Phụ Sản: 7h30 – 20h00<br>
                            Khám Tai Mũi Họng: 8h00 – 17h00<br>
                            Khám Răng hàm mặt: 8h00 – 17h00<br>
                            Khám Nhi: 8h00 – 17h00<br>
                            Khám Ung bướu: Thứ 2 đến thứ 7 từ 8h00-17h00<br>
                            Khám Mắt, Da liễu: Thứ 2 đến thứ 7 từ 8h00-17h00<br></p>
                        </div>
                        <div class="col-sm">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6094175111193!2d105.79351121457799!3d21.00828818600949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad09966c771d%3A0xb7452a901ca9f4c0!2zUGjDsm5nIEtow6FtIMSQYSBLaG9hIFRodSBDw7pjIChUQ0kp!5e0!3m2!1svi!2s!4v1678201284539!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                            <li style="text-decoration: none; list-style:none">
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
                                <div class="content">
                                    {{ $new->content }}
                                </div>
                                
                            </li>
                        @endforeach
                    </ul>
                   
                </div>
            </div>
        </div>
        
    </div>
</div>
@include('user.footer')