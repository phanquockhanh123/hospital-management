<div class="page-section bg-light">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Tin mới nhất</h1>
      <div class="row mt-5">
        @foreach ($news as $new)
        <div class="col-lg-4 py-2 wow zoomIn">
          <div class="card-blog">
            <div class="header">
              {{-- <div class="post-category">
                <a href="#">{{ $new->title }}</a>
              </div> --}}
              <a href="blog-details.html" class="post-thumb">
                  <img src="{{ asset('./imgNews/'. $new->filename) }}" 
                              style="vertical-align: middle;
                                  width: 200px;
                                  height: 300px;">
              </tr>
              </a>
            </div>
            <div class="body">
              <h5 class="post-title"><a href="blog-details.html">{{ $new->title }}</a></h5>
              <div class="site-info">
                <div class="avatar mr-2">
                  <div class="avatar-img">
                    <img src="../assets/img/person/person_1.jpg" alt="">
                  </div>
                  <span>{{ $new->author }}</span>
                </div>
                <span class="mai-time">{{ $new->updated_at->diffForHumans() }}</span>
              </div>
            </div>
          </div>
        </div>
        @endforeach
       

        <div class="col-12 text-center mt-4 wow zoomIn">
          <a href="{{ route('home.blog') }}" class="btn btn-primary">Xem thêm</a>
        </div>

      </div>
    </div>
  </div> <!-- .page-section -->