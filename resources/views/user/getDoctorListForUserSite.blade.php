@include('user.header')

<div class="page-section">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp">Đội ngũ chuyên gia</h1>
        <div>
            @foreach ($departments as $department)
                <h2>{{ $department->name }} ({{ $department->doctors_count }} doctors)</h2>
                <div class="item" style="display:flex;">
                    @foreach ($department->doctors as $doctor)
                    <div class="card-doctor" style=" width: calc(100%/3 - 24px);
                                margin-right: calc(3*24px/2);
                                margin-bottom: 36px;
                                border: 1px solid #ddd;
                                border-radius: 8px;">
                        <div class="header">
                            <img src="{{ asset('./imgDoctor/'. $doctor->filename) }}" style="weight:350px; height:370px"
                                alt="">
                        </div>
                        <div class="body">
                            <p class="text-xl mb-0"><a
                                    href="{{ route('home.get-doctor-detail-for-user-site', $doctor) }}">{{ $doctor->name }}</a>
                            </p>
                            <span class="text-sm text-grey">{{ $doctor->specialist }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>

<ul>

</ul>

@include('user.footer')