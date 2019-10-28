@extends('layouts.consultant')

@section('title','Home')

@section('content')
<div class="col-md-9 text-center">
  <h4>Tickets</h4>

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
<ul class="list-group list-group-flush" style="height:50vh;overflow-y:auto;">
  @foreach (range(1,10) as $range)
    <li class="list-group-item">
      <small>
        <b>{{Auth::user()->name}}</b> changes Ticket <b>LO-MM-1-1</b> status to <b>WORKING</b>
      </small>
    </li>
  @endforeach
</ul>
</div>
</div>
@endsection

@push('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $('table').DataTable();
    });
  </script>
@endpush
