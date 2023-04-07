@include('user.header')

<div class="page-section">
    <div class="container">
        <div class="content" style="display:flex; margin: 24px 0 24px;">
            <img src="{{ asset('./imgDoctor/'. $doctor->filename) }}" style="weight:350px; height:370px;margin-right: 100px;" alt="">
            <div class="body">
                <h3 style="color: #006632">{{ $doctor->name}}</h3>
                <span style="display: inline-block; padding: 12px; border-radius: 5px;
                background-color: #f1f1f1;
                color: orange;
                font-weight: 500;">{{ $doctor->doctorDepartment->name }}</span>
                <h5>Chuyên ngành: {{ $doctor->specialist }}</h5>
                <div style="border: 1px solid orange; padding: 5px 15px;font-size:25px;">Liên hệ: {{ $doctor->phone }}</div>
            </div>
        </div>
        <div class="info-doctor">
            <p>{{ $doctor->designation }}</p>
            <p>{{ $doctor->academic_level }}</p>
            <p>{{ $doctor->start_work_date }}</p>
            <p>{{ $doctor->identity_nunmber }}</p>
            <p>{{ $doctor->identity_card_date }}</p>
            <p>{{ $doctor->identity_card_place }}</p>
       </div>
       <div class="page-section">
        <div class="container">
          <h1 class="text-center mb-5 wow fadeInUp">XEM THÊM BÁC SĨ</h1>
    
          <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
            @foreach($doctors as $doctor)
            <div class="item">
              <div class="card-doctor">
                <div class="header">
                  <img src="{{ asset('./imgDoctor/'. $doctor->filename) }}" alt="">
                  <div class="meta">
                    <a href="#"><span class="mai-call"></span></a>
                    <a href="#"><span class="mai-logo-whatsapp"></span></a>
                  </div>
                </div>
                <div class="body">
                  <p class="text-xl mb-0">{{ $doctor->name }}</p>
                  <span class="text-sm text-grey">{{ $doctor->specialist }}</span>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    
</div>

@include('user.footer')