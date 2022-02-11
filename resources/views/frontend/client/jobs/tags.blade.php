<div class="form-group">
    <p>Tags</p>
    <input class="form-control" name="tags" placeholder="html, css2, new2" value="" />
    <div>Please enter tags separated by commas</div>
    @if($errors->has('service_sub_type'))
        <p class="error-text"> {{ $errors->first('tags')}}  </p>
    @endif
</div>