@extends('layouts.consultant')

@section('title','Ticket')

@section('content')
  <div class="col-md-12 text-center">
    <h4>Ticket</h4>
    <hr>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Client</th>
          <th>Title</th>
          <th>Priority</th>
          <th>Status</th>
          <th>Timestamp</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Client</th>
          <th>PIC</th>
          <th>Priority</th>
          <th>Status</th>
          <th>Timestamp</th>
        </tr>
      </tfoot>
    </table>
  </div>
@endsection

@push('script')
  <script type="text/javascript">
    var table = $('#ticketTable');
    var timeout;

  function getTickets() {
    $.get('/ticketdata', function(resp){
      table.clear().draw();
      table.rows.add(resp).draw();
      timeout = setTimeout(function () {
        getTickets()
      }, 5000);
    });
  }

    $(document).ready(function(){
      table = $('table').DataTable({
        serverSide: false,
        processing: true,
        paging: true,
        language: {
            emptyTable: "No Ticket Found"
        },
        data: [],
        columns: [
          {data: 'id'},
          {data: 'client_full'},
          {data: 'title'},
          {data: 'priority'},
          {data: 'status'},
          {data: 'created_at'},
        ]
      });

      $('table').on('click', 'tbody tr', function() {
        var id = table.row(this).data()['id'];
        window.location.href = '/ticket/'+id;
      });

      getTickets();
    });
  </script>
@endpush
