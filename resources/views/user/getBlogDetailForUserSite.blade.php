@include('user.header')

<div class="page-section">
    <div class="container">
        <div class="content" style=" margin: 24px 0 24px;">
            <h3 style="color: #006632;margin-bottom: 35px;"><b> {{ $blog->title}}</b></h3>
            <img src="{{ asset('./imgNews/'. $blog->filename) }}" style="width:80%;height:370px;margin-right: 100px;margin-left:100px;" alt="">
                  <p style="margin-bottom: 35px;margin-top: 20px;"><b></b> {{ $blog->content }}</p>
                  <p style="margin-bottom: 35px;"><b>Ngày tạo:</b> {{ $blog->submitted_date?->format('d/m/Y') }}</p>
                  <p style="margin-bottom: 35px;"><b>Tác giả:</b> {{ $blog->author }}</p>
            </div>
        </div>
       
       {{-- <div class="page-section">
        <div class="container">
          <h1 class="text-center mb-5 wow fadeInUp">XEM THÊM BÁC SĨ</h1>
    
          <div class="owl-carousel wow fadeInUp" id="blogSlideshow">
            @foreach($blogs as $blog)
            <div class="item">
              <div class="card-blog">
                <div class="header">
                  <img src="{{ asset('./imgblog/'. $blog->filename) }}" alt="">
                  <div class="meta">
                    <a href="#"><span class="mai-call"></span></a>
                    <a href="#"><span class="mai-logo-whatsapp"></span></a>
                  </div>
                </div>
                <div class="body">
                  <p class="text-xl mb-0">{{ $blog->name }}</p>
                  <span class="text-sm text-grey">{{ $blog->specialist }}</span>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div> --}}
    </div>
    
</div>

@include('user.footer')