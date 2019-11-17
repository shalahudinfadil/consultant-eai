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
      </div>
    </div>
    </div>
  </div>
@endsection
