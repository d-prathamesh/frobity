@extends('frontend.partner.layout')
@section('content')
<style>
  .job:before {
    border-bottom: 4px solid #f4f4f4;
  }
  .job .bottom-sec p i{
    font-size: 16px;
  }

  .job .mid-sec .label-success {
    background: #ffffff !important;
    color: #30c4cf !important;
    border: 1px solid #30c4cf;
  }
  .job .mid-sec p {
    padding-bottom: 20px;
  }
</style>
	    <div class="work" style="padding:10px 0px;">
		
        <div class="col-lg-12">
          <div class="icon">
           <p class="tr-title"><i class="fa fa-list" aria-hidden="true"></i>Find Jobs</p>
          </div> 

          <form id="submit-search" action="/partner/find-jobs#" method="post" class="list-search revealOnScroll fadeInDown animated" data-animation="fadeInDown" data-timeout="200">
            <button id=""><i class="fa fa-search"></i></button>
            <input type="text" id="search-input" class="form-control" placeholder="Job title, keywords or company name" value="">
            <div class="clearfix"></div>
           </form>
        </div> 
    @include('frontend.partner.jobs.listitemblock')
    </div>
@stop
@section('scripts')
<script type="text/javascript">
  $(document).ready( function(){
    $("#submit-search").submit( function(){
      search_string = $("#search-input").val();
      var final_url = '/partner/find-jobs/'+search_string;
      getJobsSearch( final_url );
            return false;
    });
    $(".pagination-container .pagination li a").click( function() {
      var url_href= $(this).attr('href');
//      console.log( "in pagi click " + url_href );
      final_url = get_search_url( url_href );
      getJobsSearch( final_url );
      return false;
    });
  });
  
  function get_search_url( url_href ){
    search_string = $("#search-input").val();
    console.log( "in function" + url_href );
    if( search_string ){
      url_href = url_href.split( '?' );
      var final_url = url_href['0']+"/"+search_string+"?"+url_href['1'];
    }else{
      var final_url = url_href;
    }
    return final_url;
  }

  function getJobsSearch( $url ){

          $.ajax({
                url: $url,//'/partner/find-jobs/'+search_string,
                type:"GET",
                data: {listing_only:1},
                success:function(response){
                    //console.log(response);
                    $("#joblisting").html( response );
                    $(".pagination-container .pagination li a").click( function() {
                      var url_href= $(this).attr('href');

                      final_url = get_search_url( url_href );
                      getJobsSearch( final_url );
                      return false;
                    });

                },
                error:function( jqXHR, textStatus, errorThrown ){
                    console.log('jqxhr');
                    console.log( jqXHR.responseJSON );
                        resp_json = jqXHR.responseJSON;
                    console.log('textStatus');
                    console.log( textStatus );
                    
                    console.log('errorThrown');
                    console.log( errorThrown );
                    var first_err = '';
                        for( k in resp_json ){
                            if(  k != 'longitude' && k != 'latitude' && first_err=='' ){
                                first_err = k;                               
                            }
                            console.log(" key " + k );
                            console.log(" value " + resp_json[k]);
                            $("#error_"+k).html(resp_json[k]);
                            $("#error_"+k).removeClass('hidden');

                        }
                        if( first_err != '' ){
                            console.log( "#error_"+first_err );
                            $([document.documentElement, document.body]).animate({
                                scrollTop: $("#error_"+first_err).offset().top-50
                            }, 100);
                            $( "#error_"+first_err ).focus();
                        }
                }
            });
  }

</script>


<!--script src="{{ asset('/js/paginathing.min.js') }}"></script>
<script>
  $('ul#joblist').paginathing();
</script-->
@stop