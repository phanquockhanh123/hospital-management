@include('user.header')


<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100"
                src="https://th.bing.com/th/id/R.bff0cf117e3635c8081f7f7d99964f29?rik=bRT614ium3EU7g&pid=ImgRaw&r=0"
                height="500px" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://www.webinventiv.com/images/services/hospital-management-system.png"
                height="500px" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100"
                src="https://acsonnet.com/wp-content/uploads/2021/05/Hospital-Management-System.jpg" height="500px"
                alt="Third slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100"
                src="https://th.bing.com/th/id/R.e2e5a0c6654364ec966a184312270e03?rik=uvBb3%2bpJvRv1ag&riu=http%3a%2f%2fonline.shsu.edu%2fdegrees%2fundergraduate%2fhealth-care-administration%2fmedia%2fHealth-Care-Administration_updated.jpg&ehk=DDksngocyKfADuWLrKY6jwkNvojKRQs1rIa7s8G%2boLM%3d&risl=&pid=ImgRaw&r=0"
                height="500px" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100"
                src="https://businessfirstfamily.com/wp-content/uploads/2017/03/healthcare-management-adminstration-differences.jpg"
                height="500px" alt="Second slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="container" style="margin-top:50px;">

    {{-- <div class="section" id="section-01">
        <div class="inner-wp">
            <div class="section-head">
                <h2 class="section-title" style="color: aqua">Giới thiệu</h2>
            </div>
        </div>
    </div> --}}
    <div class="section" id="section-02">
        <div class="inner-wp">
            <div class="section-head">
                <h2 class="section-title" style="color: aqua">Giới thiệu về phòng khám An Khang</h2>
                <div class="section-desc">Phòng khám đa khoa An Khang được thành lập dựa trên ý tưởng xây dựng một phòng
                    khám với phong cách hiện đại, dịch vụ chất lượng cao. Khám và điều trị tại đây, bệnh nhân luôn được
                    đảm bảo về quyền lợi, hưởng dịch vụ y tế an toàn, tiện ích, chi phí hợp lý. Hiện phòng khám hoạt
                    động với các chuyên khoa nổi bật:</div>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <div class="icon"></div>
                        <div class="title">Nội tổng hợp</div>
                        <div class="desc">Điều trị và quản lý các bệnh lý trong cơ thể con người, bao gồm các bệnh liên quan
                             đến đường hô hấp, tiêu hóa, tim mạch, thần kinh, thận, huyết áp và chuyển hóa.</div>

                    </li>
                    <li>
                        <div class="icon"></div>
                        <div class="title">Chuyên khoa ngoại</div>
                        <div class="desc">Chẩn đoán, điều trị và phẫu thuật các bệnh lý liên quan đến bên ngoài cơ thể, 
                            bao gồm da, tóc, móng, xương, khớp, cơ, mạch máu và thần kinh ngoại vi.</div>

                    </li>
                    <li>
                        <div class="icon"></div>
                        <div class="title">Chuyên khoa nội</div>
                        <div class="desc">Chẩn đoán, điều trị và quản lý các bệnh lý trong cơ thể con người,
                             bao gồm các bệnh liên quan đến đường hô hấp, tiêu hóa, tim mạch, thần kinh, thận, huyết áp và chuyển hóa.</div>

                    </li>
                    <li>
                        <div class="icon"></div>
                        <div class="title">Chuyên khoa răng-hàm-mặt</div>
                        <div class="desc">Chẩn đoán, điều trị và phục hồi các vấn đề liên quan đến răng, hàm, cắn và mặt
                            .</div>

                    </li>
                    <li>
                        <div class="icon"></div>
                        <div class="title">Chuyên khoa tai-mũi-họng</div>
                        <div class="desc">Chẩn đoán, điều trị và quản lý các bệnh lý trong vùng tai, mũi và họng, bao gồm các vấn đề về viêm họng, viêm mũi, viêm tai giữa, polyp mũi, u cổ họng, hắt hơi liên tục, hôi miệng, khó thở và nhiều vấn đề khác liên quan đến hệ thống hô hấp trên.</div>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section" id="section-04">
        <div class="inner-wp">
            <div class="section-head">
                <h4 class="section-title" style="color: aqua">Phương pháp điều trị nổi bật</h4>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <div class="thumb"></div>
                        <div class="info">
                            <div class="title">Phương pháp điều trị bằng thuốc</div>
                            <div class="detail">Là phương pháp điều trị phổ biến với những trường hợp viêm nhiễm ở mức
                                độ nhẹ. Phòng khám An Khang kết hợp điều trị bằng thuốc Đông- Tây y kết hợp với liều
                                lượng hợp lý, giảm thiểu kháng sinh.</div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb"></div>
                        <div class="info">
                            <div class="title">Chẩn đoán hình ảnh</div>
                            <div class="detail">Phương pháp này sử dụng các kỹ thuật hình ảnh như tia X, siêu âm, CT và MRI để xem bên trong cơ thể và chẩn đoán các vấn đề sức khỏe.</div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb"></div>
                        <div class="info">
                            <div class="title">Điều trị bằng laser</div>
                            <div class="detail">Điều trị bằng laser được sử dụng trong nhiều lĩnh vực khác nhau, bao gồm phẫu thuật, thẩm mỹ và điều trị bệnh lý. Các ứng dụng phổ biến của điều trị bằng laser bao gồm xử lý tóc, trị mụn, trị sẹo và xóa bỏ nốt ruồi.
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb"></div>
                        <div class="info">
                            <div class="title">Điều trị bằng tia X</div>
                            <div class="detail">Phương pháp này được sử dụng để chẩn đoán và điều trị các vấn đề về hệ thống xương khớp, bao gồm các chấn thương và bệnh lý về xương, khớp và cột sống.</div>
                        </div>
                    </li>
                    <li>
                        <div class="thumb"></div>
                        <div class="info">
                            <div class="title">Điều trị bằng dịch vụ tâm lý</div>
                            <div class="detail">Điều trị bằng dịch vụ tâm lý được sử dụng để giúp bệnh nhân giảm stress, lo âu và trầm cảm. Các phương pháp bao gồm tư vấn, hướng dẫn tâm lý và teraphy.</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section" id="section-05">
        <div class="inner-wp">
            <div class="section-head">
                <h4 class="section-title" style="color: aqua">Hoạt động nổi bật của phòng khám</h4>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <div class="info">Hoạt động hội thảo chuyển giao công nghệ, chia sẻ kinh nghiệm y học.</div>
                    </li>
                    <li>
                        <div class="info">Hoạt động ưu đãi, hỗ trợ về chi phí khám cũng như điều trị cho người bệnh.
                        </div>
                    </li>
                    <li>
                        <div class="info">Thường xuyên thực hiện những hoạt động thiện nguyện giúp đỡ hoàn cảnh khó
                            khăn.</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section" id="section-06">
        <div class="inner-wp">
            <div class="section-head">
                <h4 class="section-title" style="color: aqua">Không gian điều trị sạch - xanh - trong lành</h4>
            </div>
            <div class="section-detail">
                <div class="block-list clearfix">
                    {{-- <div class="block-item">
                        <img class="fade" data-src="http://dakhoathaiha.com/assets/public/images/intro/thumb_04.jpg"
                            alt="Phòng khám đa khoa An Khang">
                    </div> --}}
                    <div class="block-item">
                        <ul class="list-item" style="list-style: none; margin-left: 150px;">
                            <li>
                                <div class="thumb" style="margin-bottom: 30px;">
                                    <img src="http://dakhoathaiha.com/assets/public/images/intro/thumb_05.jpg"
                                        alt="Phòng khám đa khoa An Khang" height="300px" width="700px">
                                </div>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="http://dakhoathaiha.com/assets/public/images/intro/thumb_06.jpg"
                                        alt="Phòng khám đa khoa An Khang" height="300px" width="700px">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@include('user.footer')