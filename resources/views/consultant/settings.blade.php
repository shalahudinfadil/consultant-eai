@extends('layouts.consultant')

@section('title','Settings')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header text-center">
        <h3>Update Profile</h3>
      </div>
      <div class="card-body">
        <form action="/consultant/settings/{{Auth::user()->eid}}/profile" method="post">
          @csrf
          <div class="form-group">
            <p>Name</p>
            <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}" required>
          </div>
          <button type="submit" class="btn btn-block btn-success">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update
          </button>
        </form>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-header text-center">
        <h3>Change Password</h3>
      </div>
      <div class="card-body">
        <form action="/consultant/settings/{{Auth::user()->eid}}/password" method="post">
          @csrf
          <div class="form-group">
            <p>New Password</p>
            <input class="form-control" type="password" name="newpassword" placeholder="New Password" required>
          </div>
          <div class="form-group">
            <p>Confirm Password</p>
            <input class="form-control" type="password" name="confirmpassword" placeholder="Confirm Password" required>
          </div>
          <button type="submit" class="btn btn-block btn-success">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Change
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
