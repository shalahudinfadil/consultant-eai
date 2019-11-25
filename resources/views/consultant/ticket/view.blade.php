@extends('layouts.consultant')

@section('title','View Ticket')

@section('content')
  <div class="col-md-12">
    <h4 class="text-center">Ticket #{{$ticket->ticketNumber()}}</h4>
    <hr>
    <table class="table table-bordered">
      <tr>
        <td>Priority</td>
        <td>{!! $ticket->priority() !!}</td>
      </tr>
      <tr>
        <td>Sender</td>
        <td>{{$ticket->pics->name}} ({{$ticket->clients->name}})</td>
      </tr>
      <tr>
        <td>Title</td>
        <td>{{$ticket->title}}</td>
      </tr>
      <tr>
        <td>Message</td>
        <td>{{$ticket->message}}</td>
      </tr>
      <tr>
        <td>Attached Image(s)</td>
        <td>
          @if ($ticket->img_links != null)
            <div class="row justify-content-left">
              @foreach ($ticket->img_links as $key => $img_link)
                <div class="col-md-3 p-3">
                  <div class="card">
                    <a data-fancybox="gallery" href="{{\Cloudder::secureShow($img_link)}}"><img class="img-thumbnail" src="{{\Cloudder::secureShow($img_link)}}"></a>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            No Image Attached
          @endif
        </td>
      </tr>
    </table>
  </div>
  <div class="col-md-8">
    {!! $ticket->changeStatusButton() !!}
  </div>
  <div class="col-md-4">

  </div>
@endsection
