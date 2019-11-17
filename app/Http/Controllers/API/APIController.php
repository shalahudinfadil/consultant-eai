<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Modul;
use App\Submodul;
use App\Ticket;
use App\Client;

class APIController extends Controller
{

    public function getModules($modul_id = null)
    {
      $data = ($modul_id != null) ? Modul::where('id',$modul_id)->with('submoduls')->get() : Modul::with('submoduls')->get();

      return response()->json(['data' => $data], 200);
    }

    public function getSubmodules($submodul_id = null)
    {
      $data = ($submodul_id != null) ? Submodul::where('modul_id',$modul_id)->get() : Submodul::all();

      return response()->json(['data' => $data], 200);
    }

    public function getClients($client_id = null)
    {
      $data = ($client_id != null) ? Client::where('id',$client_id)->get() : Client::all();

      return response()->json(['data' => $data], 200);
    }

    public function postTicket(Request $req)
    {
      $validate = Validator::make($req->all(), [
        'modul_id' => 'required|exists:moduls,id',
        'submodul_id' => 'required|exists:submoduls,id',
        'client_id' => 'required|exists:clients,id',
        'PIC' => 'required|exists:pics,id',
        'title' => 'required|max:255',
        'message' => 'required|max:1000',
        'priority' => 'required|between:1,3',
      ]);

      if ($validate->fails()) {
        return response()->json(['error' => $validate->errors()], 400);
      }

      $input = $req->all();
      $input['status'] = 1;
      $ticket = Ticket::create($input);

      return response()->json(['success' => 'Your ticket #'.$ticket->ticketNumber().' has been submitted!'], 200);
    }

    public function getTicket(Request $req)
    {
      $allahuakbar = explode("-",$req->ticket_number);
      $client_id = $allahuakbar[2];
      $ticket_id = $allahuakbar[3];

      try {
        $ticket = Ticket::where('client_id',$client_id)->where('id',$ticket_id)->firstOrFail();
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Ticket Not Found'], 404);
      }

        return response()->json(['data' => $ticket], 200);
    }

}
