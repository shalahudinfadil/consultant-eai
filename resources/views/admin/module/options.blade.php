@extends('layouts.admin')

@section('title','Module Options')

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
            <a href="/module" class="btn btn-sm btn-outline-secondary">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
            </a>
          </div>
          <div class="col-md-4 text-center">
            <h3>Module Options : {{$modul->name}}</h3>
          </div>
          <div class="col-md-4 text-right">
          </div>
        </div>
      </div>
      <div class="card-body">
        <form action="/module/{{$modul->id}}" method="post">
          @csrf
          @method('PUT')
          <div class="form-group row">
           <label for="eid" class="col-sm-2 col-form-label">ID</label>
           <div class="col-sm-10">
             <input type="text" class="form-control" value="{{$modul->id}}" name="id" required>
           </div>
         </div>
         <div class="form-group row">
          <label for="eid" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$modul->name}}" name="name" required>
          </div>
        </div>
       <div class="form-group row">
        <label for="eid" class="col-sm-2 col-form-label">Submodule(s)</label>
        <div class="col-sm-10" id="submodule">
          @foreach ($modul->submoduls as $sub)
            @if ($loop->first)
              <div class="row justify-content-center">
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="submodule_id[]" value="{{$sub->id}}">
                </div>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="submodule[]" value="{{$sub->name}}">
                </div>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-primary" name="button" id="add_submodule">Add</button>
                </div>
              </div>
            @else
              <div class="row justify-content-center mt-2">
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="submodule_id[]" value="{{$sub->id}}">
                </div>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="submodule[]" value="{{$sub->name}}">
                </div>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-danger remove_field" name="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
      <div class="col-md-10 offset-md-2 pt-3">
        <button type="submit" class="btn btn-success" style="width:100%">Update Module</button>
      </div>
      </form>
      </div>
    </div>
  </div>

  <script id="hidden-template" type="text/x-custom-template">
  <div class="row justify-content-center mt-2">
    <div class="col-sm-2">
      <input type="text" class="form-control" name="submodule_id[]" placeholder="Submodule ID">
    </div>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="submodule[]" placeholder="Submodule Name">
    </div>
    <div class="col-sm-2">
      <button type="button" class="btn btn-danger remove_field" name="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </div>
  </div>
</script>
@endsection

@push('script')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#add_submodule').on('click', function() {
        $('#submodule').append($('#hidden-template').html());
      });
      $('#submodule').on('click','.remove_field', function() {
        $(this).parent('div').parent('div').remove();
      });
    });
  </script>
@endpush
