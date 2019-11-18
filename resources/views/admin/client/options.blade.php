@extends('layouts.admin')

@section('title','Client Options')

@section('content')
  <div class="col-md-12 text-center">
    @if (session('status'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('status')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <div class="card text-center">
      <div class="card-header">
        <div class="row justify-content-center">
          <div class="col-md-4 text-left">
            <a href="/client" class="btn btn-sm btn-outline-secondary">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
            </a>
          </div>
          <div class="col-md-4 text-center">
            <h5>Client Options : {{$client->name}}</h5>
          </div>
          <div class="col-md-4 text-right">
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="/client/{{$client->id}}" method="post">
          @csrf
          @method('PUT')
           <div class="form-group row">
            <label for="eid" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{$client->name}}" name="name" required>
            </div>
            <div class="col-md-10 offset-md-2 pt-3">
              <button type="submit" class="btn btn-success" style="width:100%">Update Client</button>
            </div>
          </div>
        </form>
        <hr>
        <h6 class="text-center">Client Person-In-Contact(s)</h6>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Token</th>
              <th>Approval</th>
              <th>Verified</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pics as $pic)
              <tr>
                <td>{{$pic->id}}</td>
                <td>{{$pic->name}}</td>
                <td>{{$pic->email}}</td>
                <td>{{$pic->token}}</td>
                <td>{{($pic->approved_at != null) ? "Yes" : "No" }}</td>
                <td>{{($pic->verified) ? "Yes" : "No"}}</td>
                <td>
                  @if ($pic->verified == null)
                    <a href="#" class="btn btn-sm btn-secondary disabled">Unverified</a>
                  @elseif ($pic->approved_at == null && $pic->verified != null)
                    <a href="/pic/{{$pic->id}}/approve" class="btn btn-sm btn-success">Approve</a>
                  @else
                    <a href="/pic/{{$pic->id}}/unapprove" class="btn btn-sm btn-danger">Unapprove</a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    </div>
  </div>
@endsection

@push('script')
  <script type="text/javascript">
    $(document).ready(function () {
      $("table").DataTable();
    });
  </script>
@endpush
