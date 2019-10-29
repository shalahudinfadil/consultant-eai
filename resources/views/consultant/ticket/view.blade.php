@extends('layouts.consultant')

@section('title','View Ticket')

@section('content')
  <div class="col-md-12">
    <h4 class="text-center">Ticket #{{$ticket->ticketNumber()}}</h4>
    <hr>
    <table class="table table-bordered">
      <tr>
        <td>ID</td>
        <td>{{$ticket->ticketNumber()}}</td>
      </tr>
      <tr>
        <td>Sender</td>
        <td>{{$ticket->PIC}} ({{$ticket->clients->name}})</td>
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
          <div class="row justify-content-left">
            @foreach ($ticket->img_links as $key => $img_link)
              <div class="col-md-3 p-3">
                <div class="card">
                  <img src="{{$img_link}}" class="card-img-top img-thumbnail" alt="...">
                  <a target="_blank" rel="noopener noreferrer" href="{{$img_link}}" class="stretched-link"></a>
                </div>
              </div>
            @endforeach
          </div>
        </td>
      </tr>
    </table>
  </div>
  <div class="col-md-8">
    <a href="/ticket/change/".$this->
      -
    </a>
  </div>
@endsection
