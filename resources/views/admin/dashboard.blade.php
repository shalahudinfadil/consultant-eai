@extends('layouts.admin')

@section('title','Dashboard')

@section('content')
<div class="col-md-12 text-center">
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
          <h5 class="card-title">By Opening</h5>
          <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
            <label class="btn btn-sm btn-info ">
              <input type="radio" name="options" id="option1"> This Day
            </label>
            <label class="btn btn-sm btn-info ">
              <input type="radio" name="options" id="option1"> This Week
            </label>
            <label class="btn btn-sm btn-info ">
              <input type="radio" name="options" id="option1"> This Month
            </label>
            <label class="btn btn-sm btn-info ">
              <input type="radio" name="options" id="option1"> This Quarter
            </label>
          </div>
          <canvas id="chartTicketOpening" width="400" height="100"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-12 mt-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">By Closing</h5>
          <canvas id="chartTicketClosing" width="300" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="">

</div>
<div class="col-md-12 text-center">
  <h2>Client</h2>
  <hr>
  <div class="card-columns">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Client Number</h5>
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
  var ctxOpening = $('#chartTicketOpening');

  function addData(chart, label, data) {
      chart.data.labels = label;
      chart.data.datasets.forEach((dataset) => {
          dataset.data = data;
      });
      chart.update();
  }

  function removeData(chart) {
      chart.data.labels.pop();
      chart.data.datasets.forEach((dataset) => {
          dataset.data.pop();
      });
      chart.update();
  }

  function getData(chartArray) {
    $.get('/dashboard/chartdata', function(resp){
      $.each(chartArray, function(i,v){
        addData(
          v,
          resp[i]['labels'],
          resp[i]['data']
        );
        chartTimeout = setTimeout(function(){
          getData(chartArray);
        }, 300000);
      });
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

    var chartTicketOpening = new Chart(ctxOpening, {
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
    ];

    getData(chartArray);

  });
  </script>
@endpush
