@extends('layouts.consultant')

@section('title','Home')

@section('content')
<div class="col-md-9 text-center mb-5">
  <h4>Ticket</h4>
  <hr>
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">By Client</h5>
          <canvas id="chartClientStatus" width="400" height="200"></canvas>
        </div>
      </div>
      <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">By Status (This Week)</h5>
            <canvas id="chartWeekStatus" width="400" height="200"></canvas>
          </div>
        </div>
</div>
<div class="col-md-3">
  <div class="card">
  <div class="card-header text-center">
    <b>Team Members</b>
  </div>
  <ul class="list-group list-group-flush" style="height:30vh;overflow-y:auto;">
    @foreach ($members as $member)
      <li class="list-group-item">
        <small>
          <b>{{$member->name}}</b>
          <br>
          Last Login : {{$member->lastLogin()}}
        </small>
      </li>
    @endforeach
  </ul>
</div>
<div class="card">
<div class="card-header text-center">
  <b>Activity Feed</b>
</div>
<ul class="list-group list-group-flush" id="activityFeed" style="height:50vh;overflow-y:auto;">
</ul>
</div>
</div>
@endsection

@push('script')
  <script type="text/javascript">
    var chartTimeout;
    var activityFeedTimeout;

    var ctxStatus = $("#chartClientStatus");
    var ctxWeekStatus = $("#chartWeekStatus");

    function addData(chart, labels, data, label) {
        chart.data.labels = labels;
        var i = 0;
        chart.data.datasets.forEach((dataset) => {
          if(label != null) {
            dataset.data = data[i+1];
            dataset.label = label[i];
            i++;
          } else {
            dataset.data = data;
          }
        });
        chart.update();
    }

    function getData(chartArray) {
      $.get('/overview/chartdata', function(resp){
        $.each(chartArray, function(i,v){
          addData(
            v,
            resp[i]['labels'],
            resp[i]['data'],
            resp[i]['label']
          );
        });
        chartTimeout = setTimeout(function(){
          getData(chartArray);
        }, 300000);
      });
    }

    function getActivityFeed() {
      $.get('/activityfeed',function (resp) {
        $("#activityFeed").html(resp);
        activityFeedTimeout = setTimeout(function() {
          getActivityFeed();
        }, 60000);
      });
    }

    $(document).ready(function(){
      //Chart stuff - START
      var chartClientStatus = new Chart(ctxStatus, {
          type: 'bar',
          data: {
              labels: [],
              datasets: [{
                  label: 'Open',
                  data: [],
                  backgroundColor: '#1c39bb',
              },{
                  label: 'Working',
                  data: [],
                  backgroundColor: '#ff8c00',
              },{
                  label: 'Closed',
                  data: [],
                  backgroundColor: '#696969',
              },
            ]
          },
          options: {
            responseive: true,
            scales: {
    					xAxes: [{
    						stacked: true,
    					}],
    					yAxes: [{
    						stacked: true,
                ticks: {
                    beginAtZero: true
                }
    					}],
    				}
          }
      });

      var chartWeekStatus = new Chart(ctxWeekStatus, {
          type: 'bar',
          data: {
              labels: [],
              datasets: [{
                  label: '',
                  data: [],
                  backgroundColor: '#1c39bb',
              },{
                  label: '',
                  data: [],
                  backgroundColor: '#ff8c00',
              },{
                  label: '',
                  data: [],
                  backgroundColor: '#696969',
              },
            ]
          },
          options: {
            responseive: true,
            scales: {
    					xAxes: [{
    						stacked: true,
    					}],
    					yAxes: [{
    						stacked: true,
                ticks: {
                    beginAtZero: true
                }
    					}],
    				}
          }
      });

      var chartArray = [
        chartClientStatus,
        chartWeekStatus,
      ];

      getData(chartArray);
      //chart stuff - END

      //Activity Feed - START

      getActivityFeed();

      //Activity Feed - END
    });
  </script>
@endpush
