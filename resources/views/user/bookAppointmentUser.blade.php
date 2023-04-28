@include('user.header')
<section class="imageBackground">

    <div class="page-section container" style="display: flex;">
        <div class="col-md-6">
            <h2 style="color: #00D9A5">Lưu ý</h2>

            <h6 style="color:black">Quý khách vui lòng gửi thông tin chi tiết để chúng tôi có thể sắp xếp cuộc hẹn.</h6>
            <hr style="border: 1px solid #00D9A5;" />

            <ul>
                <li style="margin-top: 20px;color:black">Lịch hẹn có hiệu lực sau khi được xác nhận chính thức từ Hệ
                    thống phòng khám của chúng tôi.</li>
                <li style="margin-top: 20px;color:black">Vui lòng cung cấp thông tin chính xác để được phục vụ tốt nhất.
                    Trong trường hợp cung cấp sai thông tin email & điện thoại, việc xác nhận cuộc hẹn sẽ không hiệu
                    lực.</li>
                <li style="margin-top: 20px;color:black">Quý khách sử dụng dịch vụ Đặt hẹn trực tuyến, xin vui lòng đặt
                    trước ít nhất là 24 giờ trước khi đến khám.</li>
                <li style="margin-top: 20px;color:black">Trong những trường hợp khẩn cấp hoặc nghi ngờ có các triệu
                    chứng nguy hiểm, quý khách nên ĐẾN TRỰC TIẾP hoặc trung tâm y tế gần nhất để kịp thời xử lý.</li>
            </ul>

        </div>
        <div class="container col-md-6">
            <h1 class="text-center mb-5 wow fadeInUp" style="color: #00D9A5">ĐẶT LỊCH KHÁM</h1>

            <form method="POST" action="{{ route('user.appointments-store') }}">
                @csrf
                <div class="col-md-12">
                    <input type="text" name="fullname" class="form-control" placeholder="Họ và tên"
                        id="validationDefault01" value="" required>

                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        <input type="email" name="email" class="form-control @error('phone') is-invalid @enderror" placeholder="Email"
                            id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <input type="text" name="phone" class="form-control" placeholder="Số điện thoại"
                        id="validationDefault03" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <input type="datetime-local" name="experted_time" class="form-control"
                        placeholder="Thời gian mong muốn" id="validationDefault05" required>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" placeholder="Mô tả triệu chứng"
                        rows="5"></textarea>
                </div>
                <div class="col-12" style="margin-top: 20px; text-align: center;">
                    <button class="btn btn-primary" type="submit">Đặt lịch</button>
                </div>
            </form>

        </div>
    </div>

</section>



@include('user.footer')
