@extends('layouts.admin')

@section('title','Consultant Options')

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
            <a href="/consultant" class="btn btn-sm btn-outline-secondary">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
            </a>
          </div>
          <div class="col-md-4 text-center">
            <h5>Update Data : {{$consultant->name}}</h5>
          </div>
          <div class="col-md-4 text-right">
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="/consultant/{{$consultant->eid}}" method="post">
          @csrf
          @method('PUT')
          <div class="form-group row">
           <label for="eid" class="col-sm-2 col-form-label">EID</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" value="{{$consultant->eid}}" name="eid" required>
           </div>
         </div>
         <div class="form-group row">
          <label for="eid" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$consultant->name}}" name="name" required>
          </div>
        </div>
        <div class="form-group row">
         <label for="eid" class="col-sm-2 col-form-label">Module</label>
         <div class="col-sm-10">
           <select class="form-control" name="module" id="module" required>
             <option value="">--Select Module--</option>
             @foreach ($modul as $value)
               @if ($value->id == $consultant->assignments->modul_id)
                 <option value="{{$value->id}}" selected>{{$value->name}}</option>
               @else
                 <option value="{{$value->id}}">{{$value->name}}</option>
               @endif
             @endforeach
           </select>
         </div>
       </div>
       <div class="form-group row">
        <label for="eid" class="col-sm-2 col-form-label">Submodule</label>
        <div class="col-sm-10">
          <select class="form-control" name="submodule" id="submodule" required>
            <option value="">--Select Submodule--</option>
            @foreach ($submodul as $value)
              @if ($value->id == $consultant->assignments->submodul_id)
                <option value="{{$value->id}}" selected>{{$value->name}}</option>
              @else
                <option value="{{$value->id}}">{{$value->name}}</option>
              @endif
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-10 offset-md-2 pt-3">
        <button type="submit" class="btn btn-success" style="width:100%">Update Consultant</button>
      </div>
      </form>
      </div>
    </div>
    <div class="card text-center">
      <div class="card-header">
        <div class="row justify-content-center">
          <h4>Options</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <a href="/consultant/{{$consultant->eid}}/reset" class="btn btn-warning">
              <i class="fa fa-undo" aria-hidden="true"></i>
               Reset Password
            </a>
          </div>
          <div class="col-md-6">
            <a href="/consultant/{{$consultant->eid}}/deactivate" class="btn btn-danger">
              <i class="fa fa-times" aria-hidden="true"></i>
               Deactivate Account
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script type="text/javascript">
    var sub = $('#submodule');
    $(document).ready(function() {
      $('#module').on('change', function() {
        sub.empty();
        var id = $(this).val();
        if (id != '') {
            sub.prop('disabled',false);
            $.get('/consultant/add/'+id, function(resp) {
              sub.append($('<option>',{
                value: '',
                text: '--Select Submodule--',
              }));
              $.each(resp, function(k,v) {
                sub.append($('<option>',{
                  value: v.id,
                  text: v.name,
                }));
              });
            });
        } else {
          sub.prop('disabled',true);
        }
      });
    });
  </script>
@endpush
