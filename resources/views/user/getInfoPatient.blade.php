@include('user.header')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img src="./imgPatient/{{ $patient->filename}}" style="border-radius: 50%;vertical-align: middle;
                                          width: 50px;
                                          height: 50px;
                                          border-radius: 50%;" alt="" title="">
                        </div>

                        <h3 class="profile-username text-center">{{ $patient->name }}</h3>

                        <p class="text-muted text-center">{{ $patient->patient_code }}</p>

                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin cá nhân</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Nhóm máu</strong>

                                <p class="text-muted">
                                    @if($patient->blood_group == 0)
                                    <span class="text-primary">Group O</span>
                                    @elseif ($patient->blood_group == 1)
                                    <span class="text-primary">Group A</span>
                                    @elseif($patient->blood_group == 2)
                                    <span class="text-primary">Group B</span>
                                    @elseif($patient->blood_group == 3)
                                    <span class="text-primary">Group AB</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Số điện thoại</strong>

                                <p class="text-muted">
                                    @if ( $patient->phone )
                                    <span class="text-primary">$patient->phone</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Ngày sinh</strong>

                                <p class="text-muted">
                                    @if ( $patient->date_of_birth )
                                    <span class="text-primary">$patient->date_of_birth</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Email</strong>

                                <p class="text-muted">{{ $patient->email }}</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Giới tính</strong>

                                <p class="text-muted">
                                    @if($patient->gender == 1)
                                    <span>Nam</span>
                                    @else
                                    <span>Nữ</span>
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Số CMT/CCCD</strong>

                                <p class="text-muted">
                                    @if ( $patient->identity_number )
                                    <span class="text-primary">$patient->identity_number</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Ngày cấp</strong>

                                <p class="text-muted">
                                    @if ( $patient->identity_card_date )
                                    <span class="text-primary">$patient->identity_card_date</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>


                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Nơi cấp</strong>

                                <p class="text-muted">
                                    @if ( $patient->identity_card_place )
                                    <span class="text-primary">$patient->identity_card_place</span>
                                    @else
                                    <span class="text-primary">Đang cập nhật</span>
                                    @endif
                                </p>

                                <hr>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Chẩn
                                    đoán/ Xét nghiệm</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Đơn thuốc</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Hóa đơn</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                {{--
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                            alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>
                                            Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                            Like</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text"
                                        placeholder="Type a comment">
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg"
                                            alt="User Image">
                                        <span class="username">
                                            <a href="#">Sarah Ross</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <form class="form-horizontal">
                                        <div class="input-group input-group-sm mb-0">
                                            <input class="form-control form-control-sm" placeholder="Response">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-danger">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg"
                                            alt="User Image">
                                        <span class="username">
                                            <a href="#">Adam Jones</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Posted 5 photos - 5 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src="../../dist/img/photo2.png"
                                                        alt="Photo">
                                                    <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg"
                                                        alt="Photo">
                                                    <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>
                                            Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                            Like</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text"
                                        placeholder="Type a comment">
                                </div>
                                <!-- /.post --> --}}
                                <table class="table">
                                    @if(!empty($diagnosisesList))
                                    <tr>
                                        <th>Lịch sử khám bệnh</th>
                                        <td>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Bác sĩ khám bệnh</th>
                                                        <th>Chẩn đoán bệnh chính</th>
                                                        <th>Chẩn đoán bệnh phụ</th>
                                                        <th>Ngày khám</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($diagnosisesList as $val)
                                                    <tr>
                                                        <td>{{
                                                            $doctors->where('id', $val['doctor_id'])->first()->name
                                                            }}</td>
                                                        <td>{{ $val['main_diagnosis'] }}</td>
                                                        <td>{{ $val['side_diagnosis'] }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($val['created_at'])) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    @else
                                    Không có xét nghiệm/chẩn đoán nào !
                                    @endif
                                </table>

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <table class="table">
                                @if(!empty($diaPre))
                                <tr>
                                    <th>Lịch sử bệnh án:</th>
                                    <td>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Tên xét nghiệm</th>
                                                    <th>Kết quả</th>
                                                    <th>Trị số tham chiếu</th>
                                                    <th>Đơn vị</th>
                                                    <th>QT/PPXN</th>
                                                    <th>Lưu ý</th>
                                                    <th>Ngày xét nghiệm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($diaPre as $val)
                                                <tr>
                                                    <td>{{
                                                        $services->where('id',
                                                        $val['service_id'])->first()->service_name
                                                        }}</td>
                                                    <td>{{ $val['result'] }}</td>
                                                    <td>{{ $val['references_range'] }}</td>
                                                    <td>{{ $val['unit'] }}</td>
                                                    <td>{{ $val['method'] }}</td>
                                                    <td>{{ $val['diagnosis_note'] }}</td>
                                                    <th>{{ date('d/m/Y', strtotime($val['created_at'])) }}</th>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                @else
                                Không có đơn thuốc nào !
                                @endif
                                </table>
                                {{--
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            10 Feb. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email
                                            </h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-info"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted
                                                your friend request
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-comments bg-warning"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post
                                            </h3>

                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-success">
                                            3 Jan. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-camera bg-purple"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos
                                            </h3>

                                            <div class="timeline-body">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div> --}}
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">

                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


@include('user.footer')