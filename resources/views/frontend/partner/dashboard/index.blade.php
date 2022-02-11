@extends('frontend.partner.layout')
@section('content')
<div class="work" style="padding:10px 0px;">	
    <div class="col-lg-12">
        <div class="icon">
        <p class="tr-title"><i class="fa fa-dashboard" aria-hidden="true"></i>Dashboard</p>
        </div> 
    </div> 

    <div class="my-3">
          <div class="col-md-3">
              <div class="counter-box white r-5 p-3">
                  <div class="p-4">
                      <div class="float-right">
                          <span class="icon icon-note-list text-light-blue s-48"></span>
                      </div>
                      <div class="counter-title">Total Amount Earned</div>
                      <h5 class="mt-3">INR {{ $jobPaymentreceived }}</h5>
                  </div>
                  <div class="progress progress-xs r-0 hidden">
                      <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="900"></div>
                  </div>
              </div>
          </div>
          <div class="col-md-3 ">
              <div class="counter-box white r-5 p-3">
                  <div class="p-4">
                      <div class="float-right">
                          <span class="icon icon-mail-envelope-open s-48"></span>
                      </div>
                      <div class="counter-title ">Amount Pending</div>
                      <h5 class="mt-3">INR {{ $jobPaymentpending }}</h5>
                  </div>
                  <div class="progress progress-xs r-0 hidden">
                      <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                  </div>
              </div>
          </div>
          <div class="col-md-3 hidden">
              <div class="counter-box white r-5 p-3">
                  <div class="p-4">
                      <div class="float-right">
                          <span class="icon icon-stop-watch3 s-48"></span>
                      </div>
                      <div class="counter-title">Support Requests</div>
                      <h5 class="sc-counter mt-3 counter-animated">1,228</h5>
                  </div>
                  <div class="progress progress-xs r-0">
                      <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                  </div>
              </div>
          </div>
          <div class="col-md-3 hidden">
              <div class="counter-box white r-5 p-3">
                  <div class="p-4">
                      <div class="float-right">
                          <span class="icon icon-inbox-document-text s-48"></span>
                      </div>
                      <div class="counter-title">Support Requests</div>
                      <h5 class="sc-counter mt-3 counter-animated">550</h5>
                  </div>
                  <div class="progress progress-xs r-0">
                      <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                  </div>
              </div>
          </div>
      </div>
    <div  style="width:700px; height:700px">
      <canvas id="jobsChart" ></canvas>
    </div>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Get Started</h5>
        
      </div>
      <div class="modal-body">
        To get notication/email for best matching jobs to your skill set update your profile setting. 
        <br/><br/>
        <a href="{{ route('web.partner.setting.aboutme') }}" class="kafe-btn kafe-btn-mint-small">Update Setting</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<script>
  var ctx = document.getElementById('jobsChart').getContext('2d');
    var jobsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jobs Available', 'Proposals sent', 'Job Completed', 'Job Active'],
            datasets: [{
                label: 'Jobs',
                data: [ {{ count($applicableJobs) }} , {{ count($proposals) }}, 
                {{ count($completedJobs) }} , {{ count($ongoingJobs) }} ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                ],
                borderWidth: 1,
                fill: 'start'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            }
        }
    });
    $('#exampleModal').modal('show');
</script>
@stop