@extends('frontend.partner.layout')
@section('content')
<ul class="work" style="padding:10px 0px;">
			
        <div class="col-lg-12">
          <div class="icon">
           <p class="tr-title"><i class="fa fa-list" aria-hidden="true"></i>Identity Proof</p>
          </div> 
        </div> 
        <li class="job-box" style="">	
           @if(count($ids) < 2)
            <div  class="col-md-3">
                    <form id="submission-form" method="post" action="{{route('web.partner.setting.save-identity')}}" enctype="multipart/form-data">
                
                  <input type="hidden" name="_token" value="{{ csrf_token()}}">        <div class="identity-block-wrapper">
                    <div class="identity-block">
                            <input type="file" name="identity"  onchange="validateImage(this)" accept=".jpg, .jpeg, .png"/>
                    </div>
                </div>
                @if($errors->has('identity'))
                <p class="error-text"> {{ $errors->first('identity')}}  </p>
        @endif 
                 
                    </form>
            </div>
            @endif
            @foreach($ids as $id)
            <div  class="col-md-3">
                <img class="id-proof-image" src="{{ $id['image']}}"/>
            </div>
            @endforeach
        </li>

    </ul>
   


@stop

@section('scripts')
<script>
    function validateImage(element){
        $(element).parents('form').submit();
    }
</script>
@stop
