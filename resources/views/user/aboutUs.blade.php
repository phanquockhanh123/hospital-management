  @include('user.header')

  <div class="page-section">
      <div class="container">
          <div class="row">
              <div class="col-sm-9">
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

                                      <p>{{ $new->content }}</p>
                                      <p>Ngày cập nhật: {{ $new->updated_at->format('d/m/Y') }}</p>
                                  </div>
                              </li>
                          @endforeach
                  </div>
                  </ul>
              </div>

              <div class="col-sm-3">
                
                <div class="list-news" style="margin-left: -20px;border:1px solid orange;align-items: center" >
                  <h4 style="text-align: center;">TIN TỨC LIÊN QUAN</h4>
                    <ul>
                        @foreach ($news as $new)
                            <li style="text-decoration: none; list-style:none">
                                <a href="#" >
                                    <div class="row">
                                        <div class="col-sm" >
                                            <img src="./imgNews/{{ $new->filename}}" style="border-radius:10px;vertical-align: middle;
                                                        width: 120px;height: 80px;" alt="" title="">
                                        </div>
                                        <div class="col-sm" style="padding-left: 25px">
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
  </div>
  @include('user.footer')
