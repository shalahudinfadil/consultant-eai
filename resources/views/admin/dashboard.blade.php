@extends('layouts.admin')

@section('title','Dashboard')

@section('content')
<div class="col-md-12 text-center mb-5">
  <h2>Ticket</h2>
  <hr>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card-deck">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">By Module</h5>
            <canvas id="chartTicketModule" width="300" height="300"></canvas>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">By Priority</h5>
            <canvas id="chartTicketPriority" width="300" height="300"></canvas>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">By Status</h5>
            <canvas id="chartTicketStatus" width="300" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 mt-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">By Modules per Client</h5>
          <canvas id="chartClientModule" width="400" height="200"></canvas>
        </div>
      </div>
      <div class="card mt-3">
        <div class="card-body">
          <h5 class="card-title">By Priorities per Client</h5>
          <canvas id="chartClientPriority" width="400" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
  <script type="text/javascript">
  var chartTimeout;

  var ctxModule = $('#chartTicketModule');
  var ctxPriority = $('#chartTicketPriority');
  var ctxStatus = $('#chartTicketStatus');
  var ctxClientModule = $('#chartClientModule');
  var ctxClientPriority = $('#chartClientPriority');

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

  // function removeData(chart) {
  //     chart.data.labels.pop();
  //     chart.data.datasets.forEach((dataset) => {
  //         dataset.data.pop();
  //     });
  //     chart.update();
  // }

  function getData(chartArray) {
    $.get('/dashboard/chartdata', function(resp){
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

  $(document).ready(function () {

    var chartTicketModule = new Chart(ctxModule, {
      type: 'pie',
      data: {
        labels : [],
        datasets: [
          {
            data : [],
            backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f"],
          }
        ]
      }
    });

    var chartTicketPriority = new Chart(ctxPriority, {
      type: 'pie',
      data: {
        labels : [],
        datasets: [
          {
            data : [],
            backgroundColor: ["#32cd32", "#f4c430","#b22222"],
          }
        ]
      }
    });

    var chartTicketStatus = new Chart(ctxStatus, {
      type: 'pie',
      data: {
        labels : [],
        datasets: [
          {
            data : [],
            backgroundColor: ["#1c39bb", "#ff8c00","#696969"],
          }
        ]
      }
    });

    var chartClientModule = new Chart(ctxClientModule, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: '',
                data: [],
                backgroundColor: '#3e95cd',
            },{
                label: '',
                data: [],
                backgroundColor: '#8e5ea2',
            },{
                label: '',
                data: [],
                backgroundColor: '#3cba9f',
            },
          ]
        },
        options: {
          responsive: true,
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

    var chartClientPriority = new Chart(ctxClientPriority, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Low',
                data: [],
                backgroundColor: '#32cd32',
            },{
                label: 'Medium',
                data: [],
                backgroundColor: '#f4c430',
            },{
                label: 'High',
                data: [],
                backgroundColor: '#b22222',
            },
          ]
        },
        options: {
          responsive: true,
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
      chartTicketModule,
      chartTicketPriority,
      chartTicketStatus,
      chartClientModule,
      chartClientPriority,
    ];

    getData(chartArray);

  });
  </script>
@endpush
