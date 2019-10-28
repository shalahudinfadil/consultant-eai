@extends('layouts.admin')

@section('title','Add Consultant')

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
            <h3>Add Consultant</h3>
          </div>
          <div class="col-md-4 text-right">
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="/consultant/add" method="post">
          @csrf
          <div class="form-group row">
           <label for="eid" class="col-sm-2 col-form-label">EID</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" placeholder="EID" name="eid" required>
           </div>
         </div>
         <div class="form-group row">
          <label for="eid" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Name" name="name" required>
          </div>
        </div>
        <div class="form-group row">
         <label for="eid" class="col-sm-2 col-form-label">Module</label>
         <div class="col-sm-10">
           <select class="form-control" name="module" id="module" required>
             <option>--Select Module--</option>
             @foreach ($modul as $value)
               <option value="{{$value->id}}">{{$value->name}}</option>
             @endforeach
           </select>
         </div>
       </div>
       <div class="form-group row">
        <label for="eid" class="col-sm-2 col-form-label">Submodule</label>
        <div class="col-sm-10">
          <select class="form-control" name="submodule" id="submodule" disabled required>
          </select>
        </div>
      </div>
      <div class="col-md-10 offset-md-2 pt-3">
        <button type="submit" class="btn btn-success" style="width:100%">Add Consultant</button>
      </div>
      </form>
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
