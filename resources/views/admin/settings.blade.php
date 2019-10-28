@extends('layouts.admin')

@section('title','Settings')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header text-center">
        <h3>Change Password</h3>
      </div>
      <div class="card-body">
        <form action="/settings/{{Auth::user()->eid}}" method="post">
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
    <div class="card mt-2">
      <div class="card-header text-center">
        <h3>API Setting</h3>
      </div>
      <div class="card-body">
        <form action="#" method="post">
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
