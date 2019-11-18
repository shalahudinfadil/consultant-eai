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
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tickets as $ticket)
          <tr>
            <td>{{$ticket->ticketNumber()}}</td>
            <td>{{$ticket->pics->name}} - {{$ticket->clients->name}}</td>
            <td>{{$ticket->title}}</td>
            <td>{!! $ticket->priority() !!}</td>
            <td>{{$ticket->status()}}</td>
            <td>{{$ticket->created_at}}</td>
            <td>
              <a href="/ticket/{{$ticket->id}}" class="btn btn-sm btn-block btn-primary">
                <i class="fa fa-eye" aria-hidden="true"></i> View
              </a>
            </td>
          </tr>
        @endforeach
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
    $(document).ready(function(){
      $('table').DataTable();
    });
  </script>
@endpush
