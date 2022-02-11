        <div class="form-group">
            <p>Job Title</p>
            <input type="text" name="job_title" class="form-control" placeholder="Job title" value="">
            <p  id="error_job_title" class="hidden error-text"> {{ $errors->first('job_title')}}  </p>
        </div>