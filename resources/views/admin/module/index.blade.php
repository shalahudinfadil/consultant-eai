@extends('layouts.admin')

@section('title','Module')

@section('content')

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
              <h3>Module</h3>
            </div>
            <div class="col-md-4 text-right">
                <a href="/module/add" class="btn btn-sm btn-success">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Module
                </a>
            </div>
          </div>


        </div>
        <div class="card-body">
          <table class="table table-bordered my-5" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Submodule</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($modul as $value)
                <tr>
                  <td>{{$value->id}}</td>
                  <td>{{$value->name}}</td>
                  <td>
                    @foreach ($value->submoduls as $sub)
                      {{$sub->id}} - {{$sub->name}} <br>
                    @endforeach
                  </td>
                  <td>
                    <a href="/module/{{$value->id}}/edit" class="btn btn-sm btn-info">
                      <i class="fa fa-cogs" aria-hidden="true"></i>
                       Options
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Submodule</th>
                <th>Action</th>
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

@endsection
