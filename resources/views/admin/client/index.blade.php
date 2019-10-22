@extends('layouts.admin')

@section('title','Clients')

@section('content')
  <div class="col-md-12 text-center">
    @if (session('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('status')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <div class="card text-center">
      <div class="card-header">
        <div class="row justify-content-center">
          <div class="col-md-4">
          </div>
          <div class="col-md-4 text-center">
            <h3>Client</h3>
          </div>
          <div class="col-md-4 text-right">
              <a href="/client/add" class="btn btn-sm btn-success">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Client
              </a>
          </div>
        </div>


      </div>
      <div class="card-body">
        <table class="table table-bordered my-5" width="100%" id="consultant_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Settings</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($client as $value)
              <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->name}}</td>
                <td> <a href="/client/{{$value->eid}}/edit"><i class="fa fa-cog" aria-hidden="true"></i></a> </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Setting</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script type="text/javascript">
    $(document).ready(function() {
      $("table").DataTable();
    });
  </script>
@endpush
