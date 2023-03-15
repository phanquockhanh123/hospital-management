<div style="max-width: 1200px;
 margin-left: 350px;
 margin-top: 50px;">
    <h1 class="text-center mb-5 wow fadeInUp">Book Appointment</h1>
    <form class="row g-3">
        <div class="col-md-6">
            <label for="validationDefault01" class="form-label">Full name</label>
            <input type="text" class="form-control" id="validationDefault01" value="Mark" required>
        </div>
        <div class="col-md-6">
            <label for="validationDefaultUsername" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input type="text" class="form-control" id="validationDefaultUsername"
                    aria-describedby="inputGroupPrepend2" required>
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationDefault03" class="form-label">City</label>
            <input type="text" class="form-control" id="validationDefault03" required>
        </div>
        <div class="col-md-3">
            <label for="validationDefault04" class="form-label">State</label>
            <select class="form-select" id="validationDefault04" required>
                <option selected disabled value="">Choose...</option>
                <option>...</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="validationDefault05" class="form-label">Zip</label>
            <input type="text" class="form-control" id="validationDefault05" required>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                <label class="form-check-label" for="invalidCheck2">
                    Agree to terms and conditions
                </label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
</div>
