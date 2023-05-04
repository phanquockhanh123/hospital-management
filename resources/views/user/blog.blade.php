@include('user.header')

<div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h2 tyle="text-align: center;">Giới thiệu</h2>
                <div class="title">
                    <ul>
                        @foreach ($news as $new)
                            <li style="text-decoration: none; list-style:none; margin-bottom: 20px;">
                                <a href="#">
                                    <div class="row">
                                        <div class="col-sm">
                                            <img src="./imgNews/{{ $new->filename }}"
                                                style="border-radius:10px;vertical-align: middle;
                                                  width: 350px;height: 200px;"
                                                alt="" title="">
                                        </div>
                                </a>
                                <div class="col-sm">
                                    <h3><a href="#">{{ $new->title }}</a></h3>

                                    <p>{{ substr($new->content, 0, 50) }}...</p>
                                    <p>Ngày cập nhật: {{ $new->updated_at->format('d/m/Y') }}</p>
                                </div>
                            </li>
                        @endforeach
                </div>
                </ul>
            </div>

            <div class="col-sm-4">
              
              <div class="list-news" style="margin-left: -20px;border:1px solid orange;align-items: center" >
                <h4 style="text-align: center;margin-top:20px;color:#00D9A5;">TIN TỨC LIÊN QUAN</h4>
                <hr>
                  <ul>
                      @foreach ($news as $new)
                          <li style="text-decoration: none; list-style:none; margin-bottom: 30px;">
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
                                  {{ substr($new->content,0, 100) . '....' }}
                              </div> --}}
                              
                          </li>
                      @endforeach
                  </ul>
                 
              </div>
          </div>
        </div>
    </div>
</div>
</div>
@include('user.footer')
