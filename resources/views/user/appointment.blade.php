<div style="max-width: 1200px;
 margin-left: 200px;
 margin-top: 50px;">
    <h1 class="text-center mb-5 wow fadeInUp">Book Appointment</h1>
    <form class="row g-3" method="POST" action="{{ route('user.appointments-store') }}">
        @csrf
        <div class="col-md-6">
            <label for="validationDefault01" class="form-label">Full name</label>
            <input type="text" name="fullname" class="form-control" id="validationDefault01" value="" required>
        </div>
        <div class="col-md-6">
            <label for="validationDefaultUsername" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input type="text" name="email" class="form-control" id="validationDefaultUsername"
                    aria-describedby="inputGroupPrepend2" required>
            </div>
        </div>
        <div class="col-md-6" style="margin-top: 20px;">
            <label for="validationDefault03" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="validationDefault03" required>
        </div>
        <div class="col-md-6" style="margin-top: 20px;">
            <label for="validationDefault05" class="form-label">Expired time</label>
            <input type="date" name="experted_time" class="form-control" id="validationDefault05" required>
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            <label for="validationDefault05" class="form-label">Reason</label>
            <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="5"></textarea>
        </div>
        <div class="col-12" style="margin-top: 20px; text-align: center;">
            <button class="btn btn-primary" type="submit">Đặt lịch</button>
        </div>
    </form>

</div>

