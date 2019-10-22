@extends('layouts.admin')

@section('title','Consultants')

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
            <h3>Consultant</h3>
          </div>
          <div class="col-md-4 text-right">
              <a href="/consultant/add" class="btn btn-sm btn-success">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Consultant
              </a>
          </div>
        </div>


      </div>
      <div class="card-body">
        <table class="table table-bordered my-5" width="100%" id="consultant_table">
          <thead>
            <tr>
              <th>EID</th>
              <th>Name</th>
              <th>Module</th>
              <th>Submodule</th>
              <th>Setting</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($consultant as $value)
              <tr>
                <td>{{$value->eid}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->assignments->moduls->name}}</td>
                <td>{{$value->assignments->submoduls->name}}</td>
                <td> <a href="/consultant/{{$value->eid}}/edit"><i class="fa fa-cog" aria-hidden="true"></i></a> </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>EID</th>
              <th>Name</th>
              <th>Module</th>
              <th>Submodule</th>
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
